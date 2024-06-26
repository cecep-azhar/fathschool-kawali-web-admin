<?php

namespace Database\Seeders\Dusk;

use App\Models\Exam;
use Illuminate\Database\Seeder;

class ExamTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Exam::factory()->create([
            'name' => 'Secondary School Certificate',
        ]);

    }
}
