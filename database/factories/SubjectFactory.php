<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'course_id' => Course::inRandomOrder()->value('id'),
            'teacher_id' => User::inRandomOrder()->teacher()->value('id'),
            'name' => $this->faker->name(),
            'session_start' => '2022-08-24',
            'session_end' => '2023-08-24',
        ];
    }
}
