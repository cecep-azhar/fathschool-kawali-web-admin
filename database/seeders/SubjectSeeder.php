<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  \App\Models\Subject::factory(10)->create();
        $subjects = [
            'Bangla',
            'English',
            'Math',
            'Religion',
            'ICT',
            'Physics',
            'Chemistry',
            'Biology',
            'Higher Math',
            'Accounting',
            'Finance',
            'Business Entrepreneurship',
            'Agricultural Studies',
            'General Science',
            'History of Bangladesh',
            'Other',
            'Home Science',
        ];

        foreach ($subjects as $value) {
            $color = Arr::random([
                '#E98277',
                '#6AE9E9',
                '#5D5DEE',
                '#474778',
                '#ADD8E6',
                '#784B78',
                '#FFFF00',
                '#00FF00',
                '#FF00FF',
                '#FFC0CB',
                '#7FFFD4',
                '#808000',
                '#008000',
                '#800000',
                '#A52A2A',
                '#FFA500',
                '#000000',
                '#808080',
                '#C0C0C0',
            ]);
            Subject::create([
                'course_id' => Course::inRandomOrder()->value('id'),
                // 'teacher_id' =>  User::inRandomOrder()->teacher()->value('id'),
                'name' => $value,
                'color' => $color,
                // 'session_start' => '2022-08-24',
                // 'session_end' => '2023-08-24',
            ]);
        }
    }
}
