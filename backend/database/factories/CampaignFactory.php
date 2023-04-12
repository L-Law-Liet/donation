<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'friendly_name' => Str::random(4),
            'above' => fake()->randomFloat(2, 10, 1000),
            'campaign_id' => Campaign::find(rand(1, 40))?->id,
            'user_id' => User::first()->id,
        ];
    }
}
