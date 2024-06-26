<?php

namespace Database\Seeders;

use App\Models\ClassRoutine;
use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClassRoutineSeeder extends Seeder
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
                'course_id' => Course::inRandomOrder()->value('id'),
                'subject_id' => Subject::inRandomOrder()->value('id'),
                'weekday' => rand(1, 7),
                'start_time' => '10:00',
                'end_time' => '12:00',
            ],
            [
                'id' => 2,
                'teacher_id' => User::teacher()->inRandomOrder()->value('id'),
                'course_id' => Course::inRandomOrder()->value('id'),
                'subject_id' => Subject::inRandomOrder()->value('id'),
                'weekday' => rand(1, 7),
                'start_time' => '12:00',
                'end_time' => '14:00',
            ],
            [
                'id' => 3,
                'teacher_id' => User::teacher()->inRandomOrder()->value('id'),
                'course_id' => Course::inRandomOrder()->value('id'),
                'subject_id' => Subject::inRandomOrder()->value('id'),
                'weekday' => rand(1, 7),
                'start_time' => '14:00',
                'end_time' => '16:00',
            ],
            [
                'id' => 4,
                'teacher_id' => User::teacher()->inRandomOrder()->value('id'),
                'course_id' => Course::inRandomOrder()->value('id'),
                'subject_id' => Subject::inRandomOrder()->value('id'),
                'weekday' => rand(1, 7),
                'start_time' => '14:00',
                'end_time' => '16:00',
            ],
            [
                'id' => 5,
                'teacher_id' => User::teacher()->inRandomOrder()->value('id'),
                'course_id' => Course::inRandomOrder()->value('id'),
                'subject_id' => Subject::inRandomOrder()->value('id'),
                'weekday' => rand(1, 7),
                'start_time' => '08:00',
                'end_time' => '10:00',
            ],
            [
                'id' => 6,
                'teacher_id' => User::teacher()->inRandomOrder()->value('id'),
                'course_id' => Course::inRandomOrder()->value('id'),
                'subject_id' => Subject::inRandomOrder()->value('id'),
                'weekday' => rand(1, 7),
                'start_time' => '10:00',
                'end_time' => '12:00',
            ],
            [
                'id' => 7,
                'teacher_id' => User::teacher()->inRandomOrder()->value('id'),
                'course_id' => Course::inRandomOrder()->value('id'),
                'subject_id' => Subject::inRandomOrder()->value('id'),
                'weekday' => rand(1, 7),
                'start_time' => '12:00',
                'end_time' => '14:00',
            ],
            [
                'id' => 8,
                'teacher_id' => User::teacher()->inRandomOrder()->value('id'),
                'course_id' => Course::inRandomOrder()->value('id'),
                'subject_id' => Subject::inRandomOrder()->value('id'),
                'weekday' => rand(1, 7),
                'start_time' => '10:00',
                'end_time' => '12:00',
            ],
            [
                'id' => 9,
                'teacher_id' => User::teacher()->inRandomOrder()->value('id'),
                'course_id' => Course::inRandomOrder()->value('id'),
                'subject_id' => Subject::inRandomOrder()->value('id'),
                'weekday' => rand(1, 7),
                'start_time' => '12:00',
                'end_time' => '14:00',
            ],
            [
                'id' => 10,
                'teacher_id' => User::teacher()->inRandomOrder()->value('id'),
                'course_id' => Course::inRandomOrder()->value('id'),
                'subject_id' => Subject::inRandomOrder()->value('id'),
                'weekday' => rand(1, 7),
                'start_time' => '14:00',
                'end_time' => '16:00',
            ],
            [
                'id' => 11,
                'teacher_id' => User::teacher()->inRandomOrder()->value('id'),
                'course_id' => Course::inRandomOrder()->value('id'),
                'subject_id' => Subject::inRandomOrder()->value('id'),
                'weekday' => rand(1, 7),
                'start_time' => '10:00',
                'end_time' => '12:00',
            ],
            [
                'id' => 12,
                'teacher_id' => User::teacher()->inRandomOrder()->value('id'),
                'course_id' => Course::inRandomOrder()->value('id'),
                'subject_id' => Subject::inRandomOrder()->value('id'),
                'weekday' => rand(1, 7),
                'start_time' => '12:00',
                'end_time' => '14:00',
            ],
            [
                'id' => 13,
                'teacher_id' => User::teacher()->inRandomOrder()->value('id'),
                'course_id' => Course::inRandomOrder()->value('id'),
                'subject_id' => Subject::inRandomOrder()->value('id'),
                'weekday' => rand(1, 7),
                'start_time' => '14:00',
                'end_time' => '16:00',
            ],
            [
                'id' => 14,
                'teacher_id' => User::teacher()->inRandomOrder()->value('id'),
                'course_id' => Course::inRandomOrder()->value('id'),
                'subject_id' => Subject::inRandomOrder()->value('id'),
                'weekday' => rand(1, 7),
                'start_time' => '08:00',
                'end_time' => '10:00',
            ],
            [
                'id' => 15,
                'teacher_id' => User::teacher()->inRandomOrder()->value('id'),
                'course_id' => Course::inRandomOrder()->value('id'),
                'subject_id' => Subject::inRandomOrder()->value('id'),
                'weekday' => rand(1, 7),
                'start_time' => '10:00',
                'end_time' => '12:00',
            ],
            [
                'id' => 16,
                'teacher_id' => User::teacher()->inRandomOrder()->value('id'),
                'course_id' => Course::inRandomOrder()->value('id'),
                'subject_id' => Subject::inRandomOrder()->value('id'),
                'weekday' => rand(1, 7),
                'start_time' => '12:00',
                'end_time' => '14:00',
            ],
        ];

        ClassRoutine::insert($routines);
    }
}
