<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'description_apps',
        'features_apps',
        'advantages_apps',
        'conclusion_apps',
        'fathforce_phone_number',
        'fathforce_browser_link',
        'fathforce_email',
        'google_play_link_student',
        'google_play_link_teacher',
        'production_version_teacher',
        'production_version_student',
        'logo_fathschool',
        'logo_fathforce',
        'logo_school',
        'app_version_student',
        'app_version_teacher',
    ];

    protected $appends = [
        'logo_fathschool_url',
        'logo_fathforce_url',
        'logo_school_url',
    ];

    // accessor |  dark logo link
    public function getLogoFathschoolUrlAttribute()
    {
        $value = $this->logo_fathschool;
        if ($value) {
            return asset($value);
        }
    }

    // accessor |  light logo link
    public function getLogoFathforceUrlAttribute()
    {
        $value = $this->logo_fathforce;
        if ($value) {
            return asset($value);
        }
    }

    // accessor |  favicon icon  link
    public function getLogoSchoolUrlAttribute()
    {
        $value = $this->logo_school;
        if ($value) {
            return asset($value);
        }
    }
}
