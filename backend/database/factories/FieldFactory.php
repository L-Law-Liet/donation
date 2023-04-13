<?php

namespace Database\Factories;

use App\Models\Field;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Field>
 */
class FieldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement([Field::TYPE_TEXT, Field::TYPE_DROPDOWN]);
        $options = null;
        if ($type == Field::TYPE_DROPDOWN) {
            $options = [];
            $i = rand(1, 10);
            while ($i--) {
                $options[] = Str::random(rand(4, 8));
            }
        }
        return [
            'title' => fake()->words(2, true),
            'type' => $type,
            'value' => fake()->words(3, true),
            'options' => $options,
        ];
    }
}
