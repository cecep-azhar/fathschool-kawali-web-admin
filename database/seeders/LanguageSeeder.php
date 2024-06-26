<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'name' => 'English',
            'code' => 'en',
            'direction' => 'ltr',
        ]);

        Language::create([
            'name' => 'Bengali',
            'code' => 'bn',
            'direction' => 'ltr',
        ]);

        Language::create([
            'name' => 'Arabic',
            'code' => 'ar',
            'direction' => 'rtl',
        ]);

        // Language::create([
        //     'name' => 'Arabic',
        //     'code' => 'ar',
        //     'icon' => 'flag-icon-sa',
        //     'direction' => 'rtl',
        // ]);
    }
}
