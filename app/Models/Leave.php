<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Leave extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['days'];

    // One to one relation user subject model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // One to one relation user LeaveType model
    public function type()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }

    // accessor |  leave date format
    // public function getDateAttribute()
    // {
    //     $get_start = $this->start;
    //     $start = date('M d, Y', strtotime($get_start)).' at '.date('H:i a', strtotime($get_start));
    //     $get_end = $this->end;
    //     $end = date('M d, Y', strtotime($get_end)).' at '.date('H:i a', strtotime($get_end));

    //     return $start.' - '.$end;
    // }

    // accessor |  leave remaining days
    public function getDaysAttribute()
    {
        $start = Carbon::parse($this->start);
        $end = Carbon::parse($this->end);

        return $start->diffInDays($end) + 1 .' Days';
    }

    // Scope |  leave Pending filter
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope |  leave rejected filter
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    // Scope |  leave accepted filter
    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }
}
