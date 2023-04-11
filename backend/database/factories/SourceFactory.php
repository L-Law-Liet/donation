<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Donor;
use App\Models\Location;
use App\Models\Reason;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Source>
 */
class SourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'device_name' => fake()->macAddress(),
            'date' => now()->addDays(rand(-50, 50)),
            'pin' => rand(1000, 9999),
            'reason_id' => Reason::inRandomOrder()->first()->id,
            'campaign_id' => Campaign::inRandomOrder()->first()->id,
            'location_id' => Location::inRandomOrder()->first()->id,
            'collector_id' => Donor::collector()->inRandomOrder()->first()->id,
        ];
    }
}
