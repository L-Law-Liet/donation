<?php

namespace Database\Factories;

use App\Models\Donor;
use App\Models\Field;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FieldValue>
 */
class FieldValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $donor = Donor::inRandomOrder()->first();
        return [
            'value' => Str::random(rand(4, 8)),
            'field_id' => Field::text()->whereNotIn('id', $donor->values()->pluck('field_id'))->inRandomOrder()->first()->id,
            'donor_id' => $donor->id,
        ];
    }
}
