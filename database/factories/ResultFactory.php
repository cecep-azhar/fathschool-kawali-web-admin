<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Result>
 */
class ResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $d = rand(1, 200);

        return [
            'exam_id' => Exam::inRandomOrder()->value('id'),
            'course_id' => Course::inRandomOrder()->value('id'),
            'session' => date('Y', strtotime(Carbon::now()->addDays($d))).'-'.date('Y', strtotime(Carbon::now()->addDays($d))),
            'file' => asset('files/sample.pdf'),
        ];
    }
}
