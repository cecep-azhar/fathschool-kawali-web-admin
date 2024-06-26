<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = [
            [
                'marks' => '80-100',
                'grade' => 'A+',
                'gpa' => 4.00,
            ],
            [
                'marks' => '75-79',
                'grade' => 'A',
                'gpa' => 3.75,
            ],
            [
                'marks' => '70-74',
                'grade' => 'A-',
                'gpa' => 3.50,
            ],
            [
                'marks' => '65-69',
                'grade' => 'B+',
                'gpa' => 3.25,
            ],
            [
                'marks' => '60-64',
                'grade' => 'B',
                'gpa' => 3.00,
            ],
            [
                'marks' => '30-39',
                'grade' => 'D',
                'gpa' => 0.00,
            ],
            [
                'marks' => '0-29',
                'grade' => 'E',
                'gpa' => 0.00,
            ],
        ];

        foreach ($grades as $grade) {
            Grade::create([
                'marks' => $grade['marks'],
                'grade' => $grade['grade'],
                'gpa' => $grade['gpa'],
            ]);
        }
    }
}
