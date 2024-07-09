<?php

namespace Database\Factories;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10), // contoh: user_id diisi secara acak antara 1 dan 10
            'date' => $this->faker->date(),
            'time_in' => $this->faker->time(),
            'time_out' => $this->faker->optional()->time(), // optional() membuat time_out menjadi nullable
            'latlon_in' => $this->faker->latitude() . ',' . $this->faker->longitude(),
            'latlon_out' => $this->faker->optional()->latitude() . ',' . $this->faker->optional()->longitude(), // latlon_out bisa nullable
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
