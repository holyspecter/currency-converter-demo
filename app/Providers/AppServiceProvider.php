<?php

namespace App\Providers;

use App\Service\Calculator;
use App\Service\CalculatorInterface;
use App\Service\EcbApiConnector;
use Illuminate\Support\ServiceProvider;
use App\Service\CurrencyProviderInterface;
use App\Service\CurrencyProvider;
use App\Service\EcbApiConnectorInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CurrencyProviderInterface::class, CurrencyProvider::class);
        $this->app->bind(CalculatorInterface::class, Calculator::class);
        $this->app->bind(EcbApiConnectorInterface::class, EcbApiConnector::class);
    }
}
