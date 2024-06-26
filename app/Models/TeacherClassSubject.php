<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherClassSubject extends Model
{
    use HasFactory;

    protected $guarded = [];

    // One to one relation subject model
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
