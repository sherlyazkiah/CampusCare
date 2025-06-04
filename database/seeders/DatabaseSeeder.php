<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            FloorSeeder::class,
            RoomSeeder::class,
            FacilitiessSeeder::class,
            ReportSeeder::class,
            BiodataSeeder::class,
        ]);
    }
}
