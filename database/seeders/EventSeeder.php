<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::create([
            'title' => 'Ekla Boishakh',
            'start' => Carbon::now()->addDay(2),
            'end' => Carbon::now()->addDay(8),
        ]);

        Event::create([
            'title' => 'Birth Day',
            'start' => Carbon::now()->addDay(1),
            'end' => Carbon::now()->addDay(9),
        ]);

        Event::create([
            'title' => 'Garden',
            'start' => Carbon::now()->addDay(12),
            'end' => Carbon::now(13),
        ]);

        Event::create([
            'title' => 'Rose Day',
            'start' => Carbon::now()->addDay(1),
            'end' => Carbon::now()->addDay(2),
        ]);

        Event::create([
            'title' => 'Baul Mela',
            'start' => Carbon::now()->subDay(2),
            'end' => Carbon::now()->addDay(1),
        ]);

        Event::create([
            'title' => 'Weddings',
            'start' => Carbon::now()->subDay(4),
            'end' => Carbon::now()->subDay(1),
        ]);

        Event::create([
            'title' => 'Independence and National Day',
            'start' => Carbon::now()->addDay(4),
            'end' => Carbon::now()->addDay(6),
        ]);

        Event::create([
            'title' => 'Eid ul-Adha',
            'start' => Carbon::now()->addDay(4),
            'end' => Carbon::now()->addDay(6),
        ]);
    }
}
