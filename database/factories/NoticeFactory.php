<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notice>
 */
class NoticeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'title' => $this->faker->name(),
            'description' => $this->faker->text(500),
            'status' => Arr::random(['public', 'private']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'attachment' => $this->faker->imageUrl(),
        ];
    }
}
