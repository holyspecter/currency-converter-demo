<?php

namespace App\Service;

use App\Exceptions\InvalidResponseStructureException;
use App\Model\Currency;
use GuzzleHttp\Client;

class EcbApiConnector implements EcbApiConnectorInterface
{
    const SOURCE_URL = 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';

    /** @var Client */
    private $httpClient;

    /** @var array|Currency  */
    private $currencyList = [];

    /**
     * @param Client $httpClient
     */
    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrencyList() : array
    {
        if (!empty($this->currencyList)) {
            return $this->currencyList;
        }

        $response = $this->httpClient->request('GET', self::SOURCE_URL);
        $data = simplexml_load_string($response->getBody()->getContents());

        $this->checkResponseStructure($data);

        /** @var \SimpleXMLElement $item */
        foreach ($data->Cube->Cube[0]->Cube as $item) {
            $attributes = $item->attributes();
            if (empty($attributes['currency']) || empty($attributes['rate'])) {
                continue;
            }

            $this->currencyList[] = new Currency(
                (string) $attributes['currency'],
                (float) $attributes['rate']
            );
        }

        return $this->currencyList;
    }

    /**
     * @param \SimpleXMLElement $data
     */
    private function checkResponseStructure(\SimpleXMLElement $data)
    {
        if (!property_exists($data, 'Cube')
            || !property_exists($data->Cube, 'Cube')
            || empty($data->Cube->Cube[0])
            || !property_exists($data->Cube->Cube[0], 'Cube')
        ) {
            throw new InvalidResponseStructureException();
        }
    }
}
