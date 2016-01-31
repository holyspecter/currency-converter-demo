<?php

namespace App\Service;

use App\Model\Currency;

interface EcbApiConnectorInterface
{
    /**
     * @return array|Currency
     */
    public function getCurrencyList() : array;
}
