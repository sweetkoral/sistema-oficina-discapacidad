<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class VercelServiceProvider extends ServiceProvider
{
    public function register()
    {
        if (env('VERCEL')) {
            $storagePath = env('APP_STORAGE', '/tmp/storage');
            $this->app->instance('path.storage', $storagePath);

            // Set specific config for paths
            config(['view.compiled' => $storagePath . '/framework/views']);
            config(['cache.stores.file.path' => $storagePath . '/framework/cache']);
            config(['session.files' => $storagePath . '/framework/sessions']);
        }
    }

    public function boot()
    {
        if (env('RUN_MIGRATIONS')) {
            try {
                // Check if database is already migrated
                \Illuminate\Support\Facades\Schema::hasTable('users');
            } catch (\Exception $e) {
                // If not, run migrations
                \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
            }
        }
    }
}
