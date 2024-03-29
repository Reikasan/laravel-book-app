<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BookSeeder::class,
            TagSeeder::class,
            UserSeeder::class,
            ReviewSeeder::class,
            ReviewTagSeeder::class,
            WishlistSeeder::class,
        ]);
    }
}
