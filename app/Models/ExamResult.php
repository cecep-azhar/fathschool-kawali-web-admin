<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;

    protected $fillable = ['exam_id', 'attachment'];

    protected $appends = ['attachment_url'];

    public function getAttachmentUrlAttribute()
    {
        if (! $this->attachment) {
            return asset('files/result.xlsx');
        }

        return asset($this->attachment);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
