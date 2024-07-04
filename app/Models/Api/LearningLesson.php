<?php

namespace App\Models\Api;

use App\Models\User;
use App\Models\Api\ClassList;
use App\Models\Api\Lesson;
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

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lessons_id');
    }

    public function classList()
    {
        return $this->belongsTo(ClassList::class, 'class_lists_id');
    }
}
