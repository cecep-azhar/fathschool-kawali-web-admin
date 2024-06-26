<?php

namespace Database\Seeders\Dusk;

use App\Models\ClassRoutine;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClassRoutineTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routines = [
            [
                'id' => 1,
                'teacher_id' => User::teacher()->inRandomOrder()->value('id'),
                'course_id' => 1,
                'subject_id' => 1,
                'weekday' => rand(1, 7),
                'start_time' => '10:00',
                'end_time' => '12:00',
            ],
            [
                'id' => 2,
                'teacher_id' => User::teacher()->inRandomOrder()->value('id'),
                'course_id' => 1,
                'subject_id' => 1,
                'weekday' => rand(1, 7),
                'start_time' => '12:00',
                'end_time' => '14:00',
            ],
            [
                'id' => 3,
                'teacher_id' => User::teacher()->inRandomOrder()->value('id'),
                'course_id' => 1,
                'subject_id' => 1,
                'weekday' => rand(1, 7),
                'start_time' => '14:00',
                'end_time' => '16:00',
            ],
        ];

        ClassRoutine::insert($routines);
    }
}
