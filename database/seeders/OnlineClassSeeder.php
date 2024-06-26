<?php

namespace Database\Seeders;

use App\Models\OnlineClass;
use Illuminate\Database\Seeder;

class OnlineClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OnlineClass::factory()
            ->count(150)
            ->create();
    }
}
