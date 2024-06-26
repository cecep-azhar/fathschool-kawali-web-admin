<?php

namespace Database\Seeders\Dusk;

use Illuminate\Database\Seeder;

class AssignmentTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Assignment::factory(4)->create();
    }
}
