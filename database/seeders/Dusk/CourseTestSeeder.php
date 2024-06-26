<?php

namespace Database\Seeders\Dusk;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $courses = [
            ['name' => 'One', 'slug' => 'one'],
        ];

        foreach ($courses as $key => $value) {
            Course::create([
                'name' => $value['name'],
            ]);
        }
    }
}
