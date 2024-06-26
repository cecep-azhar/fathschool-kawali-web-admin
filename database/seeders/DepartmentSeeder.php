<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            'Science',
            'Commerce',
            'Arts',
            'Social',
            'Painting',
            'Dance',
            'Music',
        ];

        foreach ($departments as $d) {
            Department::create([
                'name' => $d,
            ]);
        }
    }
}
