<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatGroupConversation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['created_time', 'file_url'];

    public function getCreatedTimeAttribute()
    {
        return formatTime($this->created_at, 'H:i A');
    }

    public function getFileUrlAttribute()
    {
        $value = $this->file;
        if ($value) {
            return asset($value);
        } else {
            return;
        }
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_user_id');
    }
}
