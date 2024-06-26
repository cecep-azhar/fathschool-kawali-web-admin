<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $currency = Arr::random(['USD', 'EUR', 'GBP', 'BDT']);
        $date = $this->faker->dateTimeBetween($startDate = '-10 years', $endDate = Carbon::now()->addYears(2), $timezone = null);

        // Generate random amounts for 'amount' and 'paid_amount'
        $amount = $this->faker->numberBetween($min = 50, $max = 500);
        $paidAmount = $this->faker->numberBetween($min = 50, $max = $amount - 1); // Ensure paid_amount is less than amount


        return [
            'transaction_no' => 'TRN_'.time(),
            'title' => $this->faker->name(),
            'transaction_type_id' => TransactionType::inRandomOrder()->value('id'),
            'user_id' => User::whereIn('role', ['Admin', 'Accountant', 'Teacher'])->inRandomOrder()->value('id'),
            'amount' => $amount,
            'date' => Carbon::today()->subDays(rand(0, 13)),
            'due_date' => Arr::random([Carbon::today()->addDay(rand(1, 9)), Carbon::parse($date)->addDays(10)]),
            'paid_amount' => $paidAmount,
            'method' => Arr::random([
                'Online',
                'Cash',
                'Checks',
                'Debit cards',
                'Credit cards',
                'Mobile payments',
                'Electronic bank transfers',
            ]),
            'description' => $this->faker->text(),
            'status' => Arr::random(['paid', 'unpaid']),
            'document' => asset('files/demo.pdf'),
            'currency' => Currency::inRandomOrder()->value('code'),
        ];
    }
}
