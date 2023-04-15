<?php

namespace Database\Seeders;

use App\Models\FieldValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FieldValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FieldValue::factory(200)->create();
    }
}
