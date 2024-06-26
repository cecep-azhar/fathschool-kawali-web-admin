<?php

namespace App\Services;

use App\Models\Currency;

class CurrencyService
{
    public function currencyConversionRate()
    {
        return Currency::pluck('rate', 'code')->toArray();
    }
}
