<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignment>
 */
class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $date = rand(1, 10);

        return [
            'user_id' => User::teacher()->inRandomOrder()->value('id'),
            'subject_id' => Subject::inRandomOrder()->value('id'),
            'course_id' => Course::inRandomOrder()->value('id'),
            'title' => $this->faker->unique()->name(),
            'start_date' => Carbon::today()->subDays(rand(0, 25)),
            'end_date' => Arr::random([Carbon::today()->addDay(rand(1, 9)), Carbon::today()->subDays(rand(1, 9))]),
            'mark' => rand(50, 200),
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque ab ut doloremque, nam dolorem et maxime molestiae veniam corrupti. Necessitatibus doloremque sapiente, voluptates id doloribus veritatis obcaecati nesciunt omnis consequuntur?',
        ];
    }
}
