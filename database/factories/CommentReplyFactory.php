<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommentReply>
 */
class CommentReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'notice_id' => Notice::inRandomOrder()->value('id'),
            'user_id' => User::inRandomOrder()->value('id'),
            'comment_id' => Comment::inRandomOrder()->value('id'),
            'comment' => $this->faker->text(200),
        ];
    }
}
