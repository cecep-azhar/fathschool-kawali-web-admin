<?php

namespace Database\Seeders\Dusk;

use App\Models\StudentAttendance;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class StudentAttendanceTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = User::student()->get();

        foreach ($students as $student) {

            StudentAttendance::create([
                'subject_id' => Subject::inRandomOrder()->value('id'),
                'teacher_id' => User::teacher()->inRandomOrder()->value('id'),
                'student_id' => $student->id,
                'status' => Arr::random(['present', 'absent', 'late']),
                'late_amount' => rand(5, 70),
                'date' => date('Y-m-d'),
            ]);
        }
    }
}
