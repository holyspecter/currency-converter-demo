<?php

namespace App\Service;

use App\Exceptions\CurrencyNotFoundException;
use App\Model\Currency;

class CurrencyProvider implements CurrencyProviderInterface
{
    /** @var EcbApiConnectorInterface  */
    private $apiConnector;

    /**
     * @param EcbApiConnectorInterface $apiConnector
     */
    public function __construct(EcbApiConnectorInterface $apiConnector)
    {
        $this->apiConnector = $apiConnector;
    }

    /**
     * {@inheritdoc}
     */
    public function findByTitle(string $title) : Currency
    {
        $currencyList = $this->getCurrencyList();

        foreach ($currencyList as $currency) {
            if ($currency->title === $title) {
                return $currency;
            }
        }

        throw new CurrencyNotFoundException();
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrencyList() : array
    {
        return $this->apiConnector->getCurrencyList();
    }
}
