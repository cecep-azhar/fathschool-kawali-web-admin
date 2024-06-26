<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionFormField extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['field_name'];

    // Accessor |  field name gen
    public function getFieldNameAttribute()
    {
        $name = $this->name;
        $remove_underscore = str_replace('_', ' ', $name);

        return ucwords($remove_underscore);
    }

    /**
     * Scope |  Define active scope for active fields
     *
     * @param  object  $query
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
