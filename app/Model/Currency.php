<?php

namespace App\Model;

class Currency
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var float
     */
    public $rate;

    /**
     * @param string $title
     * @param float  $rate
     */
    public function __construct(string $title, float $rate)
    {
        $this->title = $title;
        $this->rate  = $rate;
    }
}
