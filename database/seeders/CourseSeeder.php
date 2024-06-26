<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
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
            ['name' => 'Two', 'slug' => 'two'],
            ['name' => 'Three', 'slug' => 'three'],
            ['name' => 'Four', 'slug' => 'four'],
            ['name' => 'Five', 'slug' => 'five'],
        ];

        foreach ($courses as $key => $value) {
            Course::create([
                'name' => $value['name'],
            ]);
        }
    }
}
