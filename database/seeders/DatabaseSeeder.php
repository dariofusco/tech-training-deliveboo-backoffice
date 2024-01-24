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
        $this->call(UserSeeder::class);
        $this->call(TypologiesTableSeeder::class);
    }

    //per fare il rollback di tutte le migration e far partire tutto basta il comando 'php artisan migrate:refresh --seed'

}

