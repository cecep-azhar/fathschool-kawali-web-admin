<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatGroupUser extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userInfo()
    {
        return $this->hasOne(User::class);
    }
}
