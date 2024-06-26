<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class ChangeSettingTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = Setting::first();
        if ($setting) {
            $setting->update([
                'app_description' => 'A school management software simplifies administration by managing classes, assignments, students, and payments in one place, enhancing efficiency and productivity.',
            ]);
        }
    }
}
