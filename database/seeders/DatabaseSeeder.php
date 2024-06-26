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
            HumanSeeder::class,
            AdminSeeder::class,
            BankSeeder::class,
            AdminBankAccountSeeder::class,
            CategorySeeder::class
        ]);
    }
}
