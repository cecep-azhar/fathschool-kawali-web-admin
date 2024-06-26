<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Notice extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['time', 'attachment_url', 'publish_at'];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value).'-'.time();
    }

    // One to one relation with user model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // One to many relation with comment model
    public function comments()
    {
        return $this->hasMany(Comment::class, 'notice_id', 'id');
    }

    // accessor |  notice Publish date format
    public function getPublishAtAttribute()
    {
        $time = $this->created_at;

        return date('M d, Y', strtotime($time)).' at '.date('h:i A', strtotime($time));
    }

    // accessor |  notice time format
    public function getTimeAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    // accessor |  notice attachment url
    public function getAttachmentUrlAttribute()
    {
        $url = $this->attachment;
        if ($url) {
            return asset($url);
        }
    }

    // Scope |  public items
    public function scopePublic($query)
    {
        return $query->where('status', 'public');
    }

    // Scope |  public items
    public function scopePrivate($query)
    {
        return $query->where('status', 'private');
    }
}
