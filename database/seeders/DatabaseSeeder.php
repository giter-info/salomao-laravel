<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (config('database.default') === 'sqlite') {
            $databasePath = database_path('database.sqlite');

            if (! File::exists($databasePath)) {
                File::ensureDirectoryExists(database_path());
                File::put($databasePath, '');
            }
        }

        $this->call([
            AdminUserSeeder::class,
            SalomaoSiteSeeder::class,
            SalomaoMediaSeeder::class,
        ]);
    }
}
