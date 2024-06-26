<?php

namespace Database\Seeders;

use App\Models\ChatGroupUser;
use Illuminate\Database\Seeder;

class ChatGroupUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChatGroupUser::factory(20)->create();
    }
}
