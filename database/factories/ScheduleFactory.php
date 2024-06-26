<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $time = rand(1, 100);

        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'title' => $this->faker->name(),
            'start' => Carbon::now()->addDays($time),
            'end' => Carbon::now()->addDays($time),
        ];
    }
}
