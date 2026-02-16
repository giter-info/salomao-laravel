<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('database.default') !== 'sqlite') {
            return;
        }

        $databasePath = config('database.connections.sqlite.database');

        if (! is_string($databasePath) || $databasePath === '' || $databasePath === ':memory:') {
            return;
        }

        $databaseDirectory = dirname($databasePath);

        if (! File::exists($databaseDirectory)) {
            File::ensureDirectoryExists($databaseDirectory);
        }

        if (! File::exists($databasePath)) {
            File::put($databasePath, '');
        }
    }
}
