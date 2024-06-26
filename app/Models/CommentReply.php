<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['time'];

    // accessor |  comment release date format
    public function getTimeAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

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
}
