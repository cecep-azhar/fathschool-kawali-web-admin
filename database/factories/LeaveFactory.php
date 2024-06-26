<?php

namespace Database\Factories;

use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leave>
 */
class LeaveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::all()->random();

        return [
            'user_id' => $user->id,
            'leave_type_id' => LeaveType::inRandomOrder()->value('id'),
            'title' => $user->name,
            'start' => $this->faker->date(),
            'end' => $this->faker->date(),
            'status' => Arr::random(['pending', 'accepted', 'rejected']),
            'description' => $this->faker->text(),
        ];
    }
}
