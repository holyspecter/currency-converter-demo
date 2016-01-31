<?php

namespace App\Http\Controllers;

use App\Service\CalculatorInterface;
use App\Service\CurrencyProviderInterface;
use Illuminate\Http\Request;
use App\Exceptions\CurrencyNotFoundException;

class MainController extends Controller
{
    /** @var CurrencyProviderInterface  */
    private $currencyProvider;

    /** @var CalculatorInterface  */
    private $calculator;

    /**
     * @param CurrencyProviderInterface $currencyProvider
     * @param CalculatorInterface       $calculator
     */
    public function __construct(
        CurrencyProviderInterface $currencyProvider,
        CalculatorInterface $calculator)
    {
        $this->currencyProvider = $currencyProvider;
        $this->calculator       = $calculator;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $currencyList = [];
        $error = null;

        try {
            $currencyList = $this->currencyProvider->getCurrencyList();
        } catch (\Exception $e) {
            $error = 'Unexpected error occurred';
        }

        return view('index', [
            'currencies' => $currencyList,
            'error'      => $error,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Laravel\Lumen\Http\Redirector
     */
    public function calculate(Request $request)
    {
        $amount = (float) $request->get('amount', 0);
        $currencyTitle = (string) $request->get('currency', '');

        try {
            $currency = $this->currencyProvider->findByTitle($currencyTitle);
        } catch (CurrencyNotFoundException $e) {
            // @todo: fix session starting
            return redirect('/'); //->with('error', 'Currency was not found');
        }

        return view('calculate', [
            'amount'           => $amount,
            'calculatedAmount' => $this->calculator->calculate($amount, $currency->rate),
            'currencyTitle'    => $currencyTitle
        ]);
    }
}
