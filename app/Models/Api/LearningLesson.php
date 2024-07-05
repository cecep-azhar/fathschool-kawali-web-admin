<?php

namespace App\Models\Api;

use App\Models\User;
use App\Models\Api\ClassList;
use App\Models\Api\Lesson;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningLesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lessons_id',
        'class_lists_id',
        'time_in',
        'time_out'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subjects_id');
    }

    public function classList()
    {
        return $this->belongsTo(ClassList::class, 'class_lists_id');
    }
}
