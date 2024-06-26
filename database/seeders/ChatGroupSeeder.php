<?php

namespace Database\Seeders;

use App\Models\ChatGroup;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class ChatGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = Subject::all();

        foreach ($subjects as $key => $subject) {
            ChatGroup::create([
                'name' => $subject->name,
                'description' => 'This is '.$subject->name,
                'subject_id' => $subject->id,
            ]);
        }
    }
}
