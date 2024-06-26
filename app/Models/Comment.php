<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['time'];

    // One to one relation with user model to get commenter details
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // One to one relation with notice model to get notice details
    public function notice()
    {
        return $this->belongsTo(Notice::class, 'notice_id', 'id');
    }

    // One to many relation with Reply model to get all the reply under a comment
    public function replies()
    {
        return $this->hasMany(CommentReply::class, 'comment_id', 'id');
    }

    // accessor |  comment release date format
    public function getTimeAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
}
