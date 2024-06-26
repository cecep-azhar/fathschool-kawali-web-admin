<?php

namespace Database\Seeders\Dusk;

use App\Models\OnlineClass;
use Illuminate\Database\Seeder;

class OnlineClassTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OnlineClass::factory()
            ->count(4)
            ->create();
    }
}
