<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Exam;
use Illuminate\Database\Seeder;

class ExamResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $courses = Course::all();
        $exams = Exam::all();

        foreach ($exams as $exam) {
            $exam->examResults()->create([
                'attachment' => 'files/result.xlsx',
            ]);
            // foreach ($exams->random(5) as $exam) {
            //     $course->examResults()->attach($exam->id, [
            //         'title' => $exam->name,
            //     ]);
            // }
        }
    }
}
