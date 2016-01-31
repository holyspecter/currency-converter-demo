<?php

namespace App\Service;

interface CalculatorInterface
{
    /**
     * Calculate new amount according to the rate
     *
     * @param float $amount
     * @param float $rate
     * @return float
     */
    public function calculate(float $amount, float $rate) : float;
}
