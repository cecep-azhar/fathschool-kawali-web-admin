<?php

namespace Database\Seeders\Dusk;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::create([
            'title' => 'Eid',
            'start' => Carbon::now()->addDay(2),
            'end' => Carbon::now()->addDay(8),
        ]);
    }
}
