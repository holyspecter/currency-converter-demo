<?php

namespace App\Service;

use App\Model\Currency;

interface CurrencyProviderInterface
{
    /**
     * Retrieves list of currencies from external source
     *
     * @return array|Currency[]
     */
    public function getCurrencyList() : array;

    /**
     * Finds currency by title
     *
     * @param string $title
     * @return Currency
     */
    public function findByTitle(string $title) : Currency;
}
