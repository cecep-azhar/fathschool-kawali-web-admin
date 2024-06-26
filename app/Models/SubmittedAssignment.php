<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmittedAssignment extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'assignment_url',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // accessor |  syllabus document url gen
    public function getAssignmentUrlAttribute($value)
    {
        $value = $this->assignment;
        if ($value) {
            return asset($value);
        }
    }

    // Scope |  Completed Assignment
    public function ScopeCompleted($query)
    {
        return $query->where('completed', true);
    }

    // Scope |  Pending Assignment
    public function ScopePending($query)
    {
        return $query->where('completed', false);
    }
}
