<?php

namespace Database\Seeders\Dusk;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::factory()
            ->count(20)
            ->create();
    }
}
