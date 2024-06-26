<?php

namespace Database\Seeders\Dusk;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create([
            'course_id' => 1,
            'name' => 'Math',
            'color' => '#000',
        ]);
    }
}
