<?php

namespace App\Models\Config;

use App\Concerns\HasFilter;
use App\Concerns\HasMeta;
use App\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class MailTemplate extends Model
{
    use HasMeta, HasUuid, HasFilter, LogsActivity;

    protected $fillable = ['code', 'name', 'subject', 'content'];

    protected $primaryKey = 'id';

    protected $table = 'mail_templates';

    protected $casts = [
        'meta' => 'array',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('mail_template')
            ->logAll()
            ->logExcept(['updated_at'])
            ->logOnlyDirty();
    }
}
