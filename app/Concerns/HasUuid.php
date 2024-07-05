<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

trait HasUuid
{
    public static $fake_uuid = null;

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public static function bootHasUuid()
    {
        static::creating(function (Model $model) {
            $model->uuid = static::$fake_uuid ?? (string) Str::uuid();
        });
    }

    public function scopeFindByUuid(Builder $query, string $uuid = null): ?Builder
    {
        return $query->when($uuid, function ($q, $uuid) {
            return $q->where('uuid', '=', $uuid);
        });
    }

    public function scopeFindByUuidOrFail(Builder $query, string $uuid = null, $module = 'item', $field = 'message')
    {
        $model = $query->when($uuid, function ($q, $uuid) {
            return $q->where('uuid', '=', $uuid);
        })->first();

        if (! $model) {
            throw ValidationException::withMessages([$field => trans('global.could_not_find', ['attribute' => $module])]);
        }

        return $model;
    }

    public function scopeGetOrFail(Builder $query, $module = 'item', $field = 'message')
    {
        $model = $query->first();

        if (! $model) {
            throw ValidationException::withMessages([$field => trans('global.could_not_find', ['attribute' => $module])]);
        }

        return $model;
    }

    public function scopeGetAllOrFail(Builder $query, $module = 'item', $field = 'message')
    {
        $model = $query->get();

        if (! $model->count()) {
            throw ValidationException::withMessages([$field => trans('global.could_not_find', ['attribute' => $module])]);
        }

        return $model;
    }

    public static function filterByUuid(string $uuid = null): ?Builder
    {
        return static::when($uuid, function ($q, $uuid) {
            return $q->where('uuid', '=', $uuid);
        });
    }

    public static function findByUuidOrFail(string $uuid = null, $module = 'item', $field = 'message')
    {
        $model = static::where('uuid', '=', $uuid)->first();

        if (! $model) {
            throw ValidationException::withMessages([$field => trans('global.could_not_find', ['attribute' => $module])]);
        }

        return $model;
    }
}
