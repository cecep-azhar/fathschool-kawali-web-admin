<?php

namespace Database\Factories;

use App\Models\ChatGroup;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChatGroupUser>
 */
class ChatGroupUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = Arr::random([3, User::inRandomOrder()->value('id')]);

        return [
            'chat_group_id' => ChatGroup::inRandomOrder()->value('id'),
            'user_id' => $users,
        ];
    }
}
