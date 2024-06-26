<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $links = [
            [
                'name' => 'facebook',
                'url' => 'https://facebook.com/templatecookie',
                'icon' => 'images/svg/facebook.svg',
            ],
            [
                'name' => 'twitter',
                'url' => 'https://twitter.com/templatecookie',
                'icon' => 'images/svg/twitter.svg',
            ],
            [
                'name' => 'linkedin',
                'url' => 'https://linkedin.com/templatecookie',
                'icon' => 'images/svg/linkedin.svg',
            ],
            [
                'name' => 'instagram',
                'url' => 'https://instagram.com/templatecookie',
                'icon' => 'images/svg/instagram.svg',
            ],
        ];

        foreach ($links as $key => $link) {
            SocialLink::insert($link);
        }
    }
}
