<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Database\Seeder;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $holidays = [
            ['title' => 'Maghi Purnima', 'start' => '2023-02-05', 'end' => '2023-02-05'],
            ['title' => "Valentine's Day", 'start' => '2023-02-14', 'end' => '2023-02-14'],
            ['title' => "Language Martyrs' Day", 'start' => '2023-02-21', 'end' => '2023-02-21'],
            ['title' => 'Doljatra', 'start' => '2023-03-07', 'end' => '2023-03-07'],
            ['title' => 'Shab e-Barat', 'start' => '2023-03-08', 'end' => '2023-03-08'],
            ['title' => 'Sheikh Mujibur Rahman’s birthday', 'start' => '2023-03-17', 'end' => '2023-03-17'],
            ['title' => 'Independence Day', 'start' => '2023-03-26', 'end' => '2023-03-26'],
            ['title' => 'Chaitra Sankranti', 'start' => '2023-04-13', 'end' => '2023-04-13'],
            ['title' => 'Bengali New Year', 'start' => '2023-04-14', 'end' => '2023-04-14'],
            ['title' => 'Eid ul-Fitr', 'start' => '2023-04-22', 'end' => '2023-04-22'],
            ['title' => 'Eid ul-Fitr Holiday', 'start' => '2023-04-23', 'end' => '2023-04-23'],
            ['title' => 'May Day', 'start' => '2023-05-01',  'end' => '2023-05-01'],
            ['title' => "Mothers' Day", 'start' => '2023-05-14', 'end' => '2023-05-14'],
            ['title' => "Fathers' Day", 'start' => '2023-06-18', 'end' => '2023-06-18'],
            ['title' => 'Eid al-Adha', 'start' => '2023-06-29', 'end' => '2023-06-29'],
            ['title' => 'Eid al-Adha Holiday', 'start' => '2023-06-30', 'end' => '2023-06-30'],
            ['title' => 'Muharram', 'start' => '2023-07-19', 'end' => '2023-07-19'],
            ['title' => 'National Mourning Day', 'start' => '2023-08-15', 'end' => '2023-08-15'],
            ['title' => 'Eid e-Milad-un Nabi', 'start' => '2023-09-27', 'end' => '2023-09-27'],
            ['title' => 'Mahanabami', 'start' => '2023-10-23', 'end' => '2023-10-23'],
            ['title' => 'Prabarana Purnima', 'start' => '2023-10-28', 'end' => '2023-10-28'],
            ['title' => 'Lakshmi Puja', 'start' => '2023-10-28', 'end' => '2023-10-28'],
            ['title' => 'Halloween', 'start' => '2023-10-31', 'end' => '2023-10-31'],
            ['title' => 'Victory Day', 'start' => '2023-12-16', 'end' => '2023-12-16'],
            ['title' => 'Christmas Day', 'start' => '2023-12-25', 'end' => '2023-12-25'],
            ['title' => 'Arrival Day of Sri Sri Harichand Tagore', 'start' => '2023-03-19', 'end' => '2023-03-19'],
            ['title' => 'Shab-e-qadr', 'start' => '2023-04-19', 'end' => '2023-04-19'],
            ['title' => 'Jumatul Bidah', 'start' => '2023-04-21', 'end' => '2023-04-21'],
            ['title' => 'Buddha Purnima/Vesak', 'start' => '2023-05-04', 'end' => '2023-05-04'],
            ['title' => 'Ashura', 'start' => '2023-07-29', 'end' => '2023-07-29'],
            ['title' => 'Madhu Purnima', 'start' => '2023-09-28', 'end' => '2023-09-28'],
            ['title' => 'Mahalaya', 'start' => '2023-10-14', 'end' => '2023-10-14'],
            ['title' => 'Ashtami', 'start' => '2023-10-22', 'end' => '2023-10-22'],
            ['title' => 'Easter Monday', 'start' => '2023-04-10', 'end' => '2023-04-10'],
            ['title' => 'Eid ul-Fitr Holiday', 'start' => '2023-04-21', 'end' => '2023-04-21'],
            ['title' => 'Eid ul-Fitr Holiday', 'start' => '2023-04-24', 'end' => '2023-04-24'],
            ['title' => 'Eid al-Adha Holiday', 'start' => '2023-06-28', 'end' => '2023-06-28'],
            ['title' => 'Ashari Purnima', 'start' => '2023-08-01', 'end' => '2023-08-01'],
            ['title' => 'Akhari Chahar Somba', 'start' => '2023-09-13', 'end' => '2023-09-13'],
            ['title' => 'Fateha-i-Yajdaham', 'start' => '2023-10-27', 'end' => '2023-10-27'],
            ['title' => 'Sri Shayama Puja', 'start' => '2023-11-12', 'end' => '2023-11-12'],
        ];

        foreach ($holidays as $holiday) {
            Holiday::create($holiday);
        }
    }
}
