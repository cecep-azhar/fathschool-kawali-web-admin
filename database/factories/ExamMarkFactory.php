<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExamMark>
 */
class ExamMarkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::student()->inRandomOrder()->value('id'),
            'exam_id' => Exam::inRandomOrder()->value('id'),
            'subject' => Arr::random(['Maths', 'Science', 'English', 'Hindi', 'Social Studies']),
            'grade' => Arr::random(['A', 'B', 'C', 'D', 'E', 'F']),
            'marks' => $this->faker->numberBetween(1, 100),
            // 'class_avg_marks' => $this->faker->numberBetween(1, 100),
            // 'class_highest_marks' => $this->faker->numberBetween(1, 100),
            // 'subject_rank' => Arr::random(['1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th']),
            'grade_remarks' => Arr::random(['EXCELLENT', 'PASS', 'AVERAGE', 'FAIL', 'CREDIT']),
        ];
    }
}
