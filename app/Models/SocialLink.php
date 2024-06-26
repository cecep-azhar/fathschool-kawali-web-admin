<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['icon_url'];

    public function getIconUrlAttribute()
    {
        if (! $this->icon) {
            return asset('images/svg/link.svg');
        }

        return asset($this->icon);
    }

    // Scope |  status active
    public function scopeActive($query)
    {
        return $this->where('status', true);
    }

    // Scope |  status Not active
    public function scopeInactive($query)
    {
        return $this->where('status', false);
    }
}
