<?php

namespace Database\Seeders;

use App\Models\ChatGroupConversation;
use Illuminate\Database\Seeder;

class ChatGroupConversationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChatGroupConversation::factory(200)->create();
    }
}
