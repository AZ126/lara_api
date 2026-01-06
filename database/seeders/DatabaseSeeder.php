<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\User;
use App\Models\Wallet;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(1000)->create();
        // Wallet::factory(1000)->create();
        // Transaction::factory(5000)->create();
        Transfer::factory(5000)->create();
    }
}
