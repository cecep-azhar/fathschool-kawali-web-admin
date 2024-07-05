<?php

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Post extends Model
{
    use LogsActivity;

    protected static $logName = 'post';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $fillable = ['title', 'content'];
    public function getDescriptionForEvent(string $eventName): string
    {
        return "Post has been {$eventName}";
    }
}
