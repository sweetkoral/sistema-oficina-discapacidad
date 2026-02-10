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
                // Check for users table
                $usersExist = \Illuminate\Support\Facades\Schema::hasTable('users');

                if (!$usersExist) {
                    // Try to run migration
                    \Illuminate\Support\Facades\Artisan::call('migrate', [
                        '--force' => true,
                        '--seed' => true
                    ]);
                }
            } catch (\Exception $e) {
                // Log or report error if needed
                \Illuminate\Support\Facades\Log::error('Vercel Migration Failed: ' . $e->getMessage());
            }
        }
    }
}
