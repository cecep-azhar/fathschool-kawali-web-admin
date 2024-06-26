<?php

namespace Database\Seeders;

use App\Models\CommentReply;
use Illuminate\Database\Seeder;

class CommentReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CommentReply::factory()
            ->count(250)
            ->create();
    }
}
