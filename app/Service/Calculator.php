<?php

namespace App\Service;

class Calculator implements CalculatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function calculate(float $amount, float $rate) : float
    {
        return $amount * $rate;
    }
}
