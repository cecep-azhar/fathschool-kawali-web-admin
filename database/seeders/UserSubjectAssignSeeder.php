<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSubjectAssignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = User::teacher()->get();
        $subjects = Subject::all();

        foreach ($teachers as $key => $teacher) {

            foreach ($subjects as $key => $value) {
                $teacher->subjects()->create([
                    'teacher_id' => $teacher->id,
                    'subject_id' => $value->id,
                ]);
            }
        }
    }
}
