<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['status', 'remaining_days'];

    // accessor |  event start date format
    public function getStartAttribute($value)
    {
        return date('Y-m-d', strtotime($value));
    }

    // accessor |  event end date format
    public function getEndAttribute($value)
    {
        return date('Y-m-d', strtotime($value));
    }

    // accessor |  event status
    public function getStatusAttribute()
    {
        $start_time = Carbon::parse($this->start)->endOfDay();
        $now = Carbon::now()->endOfDay();

        if ($start_time > $now) {
            return 'Upcoming';
        } elseif ($start_time == $now) {
            return 'Running';
        } else {
            return 'Ended';
        }
    }

    // accessor |  event remaining days get
    public function getRemainingDaysAttribute()
    {
        $start = Carbon::parse($this->start);
        $end = Carbon::parse($this->end);

        return $start->diffInDays($end);
    }
}
