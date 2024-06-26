<?php

namespace Database\Seeders\Dusk;

use Illuminate\Database\Seeder;

class LeaveTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Leave::factory(5)->create([
            'status' => 'pending',
        ]);
    }
}
