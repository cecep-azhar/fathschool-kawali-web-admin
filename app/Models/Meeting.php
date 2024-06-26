<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meeting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'start_date_format',
        'meeting_status',
    ];

    // One to one relation with user model
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    // accessor |  meeting date format
    public function getStartDateFormatAttribute()
    {
        $value = $this->start_time;

        return formatTime($value, '', 'h:i A');
    }

    /**
     * One to Many Relationship with MeetingAttendee model to
     * get all participants Under a meeting
     */
    public function participants(): HasMany
    {
        return $this->hasMany(MeetingAttendee::class, 'meeting_id');
    }

    /**
     * Meeting status set
     */
    public function getMeetingStatusAttribute()
    {
        $start_date = Carbon::parse($this->start_date)->format('d-m-Y');
        $today = Carbon::now()->format('d-m-Y');
        if ($today >= $start_date) {
            return 'Expired';
        } else {
            return 'Active';
        }
    }
}
