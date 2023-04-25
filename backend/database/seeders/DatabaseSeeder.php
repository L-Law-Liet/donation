<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(2)->create();
         Auth::login(User::first());
         $this->call([
             CampaignSeeder::class,
             FieldSeeder::class,
             OptionSeeder::class,
             TagSeeder::class,
             DonorSeeder::class,
             DonorLocationSeeder::class,
             ReasonSeeder::class,
             LocationSeeder::class,
             SourceSeeder::class,
             TransactionSeeder::class,
             FieldValueSeeder::class,
         ]);
    }
}
