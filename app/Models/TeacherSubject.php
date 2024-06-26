<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSubject extends Model
{
    use HasFactory;

    protected $guarded = [];

    // One to one relation teacher model
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // One to many relation subject model
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    // Subject model
    public function subjects()
    {
        return $this->hasMany(Subject::class, 'subject_id');
    }
}
