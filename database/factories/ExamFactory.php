<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Grade;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $grade = Grade::inRandomOrder()->first(['gpa', 'grade']);

        return [
            'name' => Arr::random([
                'Civil Services Examination',
                'Indian Economic Service Examination',
                'Staff Selection Commission',
                'Combined Defence Services Examination',
                'National Defence Academy Examination',
                ' Food Corporation of India Examination',
                ' IBPS PO Examination',
                'State Bank of India - Probationary Officers',
            ]),
            'description' => $this->faker->text(),
            'course_id' => Course::inRandomOrder()->value('id'),
            'start_date' => Carbon::today()->subDays(rand(0, 25)),
            'end_date' => Carbon::today()->addDay(rand(1, 9)),
            'grade' => $grade->grade,
            'gpa' => $grade->gpa,
        ];
    }
}
