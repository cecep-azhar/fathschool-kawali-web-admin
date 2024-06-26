<?php

namespace App\Actions\Setting\Currency;

use App\Models\Currency;

class CreateCurrency
{
    public function execute(object $request)
    {
        return Currency::create([
            'name' => $request['name'],
            'code' => $request['code'],
            'symbol' => $request['symbol'],
            'rate' => $request['rate'],
        ]);
    }
}
