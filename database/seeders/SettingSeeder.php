<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\Timezone;
use App\Models\WorkingDays;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'app_name' => 'Schooling',
            'text_logo_name' => 'Schooling',
            'app_email' => 'Schooling@mail.com',
            'principal_name' => 'Schooling Principal',
            'app_address' => 'Dhaka, Bangladesh',
            'app_phone' => '016442290**',
            'dark_logo' => 'images/dark_logo.png',
            'light_logo' => 'images/light_logo.png',
            'favicon_icon' => 'images/favicon.png',
            'app_description' => 'Schooling is a constituent institution of the University of Dhaka.  Main goal  is to establish an institution of high academic standard for higher studies and research in economics and related disciplines. Different Economic based BSc, MSc & Diploma degrees are available here.,',

            'key_to_grades' => 'A+: 80% and Above | A: 70% - 79% | B: 60% - 69% | C: 50% - 59% | D: 40% - 49% | F: 39% and Below',
            'grade_summary' => '5(A+), 4(A), 3(B), 2(C), 1(F)',
        ]);

        // Timezone
        $path = base_path('public/json/timezones.json');
        $timezones = json_decode(file_get_contents($path), true);

        foreach ($timezones as $zone) {
            Timezone::insert([
                'value' => $zone['value'],
                'label' => $zone['label'],
            ]);
        }

        // Working days
        WorkingDays::create([
            'monday' => true,
            'tuesday' => true,
            'wednesday' => true,
            'thursday' => true,
            'friday' => true,
            'saturday' => true,
            'sunday' => false,
        ]);
    }
}
