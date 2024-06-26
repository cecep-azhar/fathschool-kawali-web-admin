<?php

namespace Database\Seeders;

use App\Models\SubmittedAssignment;
use Illuminate\Database\Seeder;

class SubmittedAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubmittedAssignment::factory()->count(200)->create();
    }
}
