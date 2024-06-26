<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use App\Models\UserCourse;
use Illuminate\Database\Seeder;

class UserCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rand_num = rand(1, 3);
        $students = User::student()->get();

        foreach ($students as $key => $value) {

            for ($i = 0; $i < $rand_num; $i++) {
                UserCourse::create([
                    'user_id' => $value->id,
                    'course_id' => Course::inRandomOrder()->value('id'),
                ]);
            }
        }
    }
}
