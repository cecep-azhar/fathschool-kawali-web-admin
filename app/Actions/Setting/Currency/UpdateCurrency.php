<?php

namespace App\Actions\Setting\Currency;

class UpdateCurrency
{
    public function execute(object $request, object $currency)
    {
        return $currency->update([
            'name' => $request['name'],
            'code' => $request['code'],
            'symbol' => $request['symbol'],
            'rate' => $request['rate'],
        ]);
    }
}
