<?php

namespace Database\Seeders;

use App\Models\StudentAttendance;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class StudentAttendanceSeeder extends Seeder
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

            for ($i = 0; $i < 100; $i++) {

                $startDate = Carbon::now()->startOfYear();
                $endDate = Carbon::now()->endOfYear();
                $randomDate = Carbon::createFromTimestamp(mt_rand($startDate->timestamp, $endDate->timestamp));

                StudentAttendance::create([
                    'subject_id' => Subject::inRandomOrder()->value('id'),
                    'teacher_id' => User::teacher()->inRandomOrder()->value('id'),
                    'student_id' => $student->id,
                    'status' => Arr::random(['present', 'absent', 'late']),
                    'late_amount' => rand(5, 70),
                    'date' => $randomDate->toDateString(),
                ]);
            }
        }
    }
}
