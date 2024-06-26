<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            [
                'name' => 'United State Dollar',
                'code' => 'USD',
                'symbol' => '$',
                'rate' => '1.00',
            ],
            [
                'name' => 'Indian Rupee	',
                'code' => 'INR',
                'symbol' => '₹',
                'rate' => '83.75',
            ],
            [
                'name' => 'Euro',
                'code' => 'EUR',
                'symbol' => '€',
                'rate' => '0.9561',
            ],
            [
                'name' => 'Bangladeshi Taka',
                'code' => 'BDT',
                'symbol' => '৳',
                'rate' => '110.75',
            ],
        ];

        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
