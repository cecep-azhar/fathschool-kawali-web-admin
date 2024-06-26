<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'date_time',
    ];

    // accessor |  attendance date time format
    public function getDateTimeAttribute()
    {
        $date = $this->date;

        return date('d/m/Y', strtotime($date));
    }

    // accessor |  attendance date format
    public function getDateAttribute($value)
    {
        return date('Y-m-d', strtotime($value));
    }

    // Scope |  attendance present filter
    public function scopePresent($query)
    {
        return $query->where('status', 'present');
    }

    // Scope |  attendance absent filter
    public function scopeAbsent($query)
    {
        return $query->where('status', 'absent');
    }

    // Scope |  attendance late filter
    public function scopeLate($query)
    {
        return $query->where('status', 'late');
    }

    /**
     * One to one relation with subject model to get subject details.
     *
     * @return object
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    /**
     * One to one relation with User model to get Teacher details.
     *
     *@return object
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     *  One to one relation with User model to get Student details.

     *
     * @return object
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
