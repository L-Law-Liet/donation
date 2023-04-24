<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Donor;
use App\Models\Location;
use App\Models\Reason;
use App\Models\Source;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'event' => Str::random(),
            'product' => Str::random(8),
            'activation_code' => rand(10000, 99999),
            'mac_address' => fake()->macAddress,
            'plan' => '$'.fake()->randomFloat(2, 20, 50).' Monthly',
            'status' => fake()->randomElement(Source::STATUSES),
            'device_type' => fake()->randomElement(Source::DEVICE_TYPES),
            'notes' => '',
            'device_num' => rand(100, 99999),
            'sim_num' => fake()->phoneNumber,
            'activated' => fake()->dateTimeBetween('-1 year'),
            'deactivated' => fake()->dateTimeBetween('-1 year'),
            'organization' => fake()->name,
            'version' => rand(10000000, 99999999),
            'pin' => rand(1000, 9999),
            'reason_id' => Reason::inRandomOrder()->first()->id,
            'campaign_id' => Campaign::inRandomOrder()->first()->id,
            'location_id' => Location::inRandomOrder()->first()->id,
            'collector_id' => Donor::collector()->inRandomOrder()->first()->id,
            'user_id' => User::first()->id,
        ];
    }
}
