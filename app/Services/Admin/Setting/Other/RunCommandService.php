<?php

namespace App\Services\Admin\Setting\Other;

use Illuminate\Support\Facades\Artisan;

class RunCommandService
{
    public function command(string $type): string
    {
        $message = match ($type) {
            'view_cache' => $this->clearViewCache(),
            'route_cache' => $this->clearRouteCache(),
            'config_cache' => $this->clearConfigCache(),
            'application_cache' => $this->clearAppCache(),
            'migrate' => $this->migrate(),
            default => throw new \Exception('Unsupported'),
        };

        return $message;
    }

    public function clearViewCache()
    {
        Artisan::call('view:clear');

        return 'View cache cleared';
    }

    public function clearRouteCache()
    {
        Artisan::call('route:clear');

        return 'Route cache cleared';
    }

    public function clearConfigCache()
    {
        Artisan::call('config:clear');

        return 'Config cache cleared';
    }

    public function clearAppCache()
    {
        Artisan::call('optimize:clear');

        return 'Application cache cleared';
    }

    public function migrate()
    {
        Artisan::call('migrate');

        return 'Application migration migrated';
    }
}
