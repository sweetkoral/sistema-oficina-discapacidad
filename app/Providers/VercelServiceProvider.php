<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class VercelServiceProvider extends ServiceProvider
{
    public function register()
    {
        if (env('VERCEL')) {
            // Re-route storage paths to /tmp since Vercel is read-only
            $this->app->instance('path.storage', '/tmp/storage');

            // Ensure directories exist
            if (!is_dir('/tmp/storage/framework/views')) {
                mkdir('/tmp/storage/framework/views', 0755, true);
            }
            if (!is_dir('/tmp/storage/framework/cache')) {
                mkdir('/tmp/storage/framework/cache', 0755, true);
            }
            if (!is_dir('/tmp/storage/framework/sessions')) {
                mkdir('/tmp/storage/framework/sessions', 0755, true);
            }
            if (!is_dir('/tmp/storage/logs')) {
                mkdir('/tmp/storage/logs', 0755, true);
            }

            // Set specific config for paths
            config(['view.compiled' => '/tmp/storage/framework/views']);
            config(['cache.stores.file.path' => '/tmp/storage/framework/cache']);
            config(['session.files' => '/tmp/storage/framework/sessions']);
        }
    }

    public function boot()
    {
        //
    }
}
