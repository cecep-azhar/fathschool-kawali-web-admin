<?php

namespace Database\Factories;

use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'transaction_no' => uniqid('tr_'),
            'user_id' => User::student()->inRandomOrder()->value('id'),
            'payment_type' => Arr::random(['stripe', 'paypal']),
            'transaction_type' => TransactionType::inRandomOrder()->value('id'),
            'amount' => $this->faker->numberBetween($min = 100, $max = 1000),
            'status' => Arr::random(['paid', 'unpaid']),
            'type' => Arr::random(['income', 'expense']),
        ];
    }
}
