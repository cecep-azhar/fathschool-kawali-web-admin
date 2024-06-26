<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubmittedAssignment>
 */
class SubmittedAssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $rand = rand(1, 31);
        $date = Carbon::now()->addDays($rand);
        $ass = Assignment::inRandomOrder()->first();

        return [
            'student_id' => User::student()->inRandomOrder()->value('id'),
            'assignment_id' => $ass->id,
            'description' => $this->faker->text(),
            'assignment' => asset('files/sample.pdf'),
            'gained_mark' => rand(50, $ass->total_mark),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
