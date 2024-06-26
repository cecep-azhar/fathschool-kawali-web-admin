<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamMark extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_id',
        'subject',
        'grade',
        'marks',
        // 'class_avg_marks',
        // 'class_highest_marks',
        // 'subject_rank',
        'grade_remarks',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
