<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Card;
use App\Models\Donor;
use App\Models\Email;
use App\Models\Field;
use App\Models\Phone;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Donor::factory(50)
            ->has(Address::factory(rand(2, 4)))
            ->has(Phone::factory(rand(2, 4)))
            ->has(Email::factory(rand(2, 4)))
            ->has(Field::factory(rand(0, 2)))
            ->has(Card::factory(rand(1, 2)))
            ->has(Tag::factory(rand(1, 3)))
            ->create();
    }
}
