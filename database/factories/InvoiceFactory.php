<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $due = rand(1, 90);
        $recurring = Arr::random([true, false]);
        $student_user = User::student()->inRandomOrder()->first();
        // $parent = $student_user->profile->parent;
        $currency = Arr::random(['USD', 'EUR', 'GBP', 'BDT']);

        return [
            'user_id' => $student_user->id,
            'title' => $this->faker->name(),
            'recurring' => $recurring,
            'recurring_status' => $recurring ? true : false,
            'recurring_date' => $recurring ? Carbon::now()->addDays(7) : null,
            'recurring_days' => $recurring ? rand(1, 4) : null,
            'invoice_no' => Str::random(12).rand(3, 2),
            'date' => $this->faker->dateTimeBetween($startDate = '-10 years', $endDate = Carbon::now()->addYears(2), $timezone = null),
            'due_date' => Carbon::now()->addDays($due),
            'amount' => rand(1, 999),
            'currency' => $currency,
            'status' => Arr::random(['paid', 'unpaid']),
            'message' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolores quaerat maiores laudantium ducimus voluptate tempora placeat vel accusamus nemo, illum amet sapiente ea rem molestias at quis recusandae corrupti fuga!',
        ];
    }
}
