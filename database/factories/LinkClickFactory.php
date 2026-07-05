<?php

namespace Database\Factories;

use App\Models\LinkClick;
use App\Models\ShortLink;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LinkClick>
 */
class LinkClickFactory extends Factory
{
    public function definition(): array
    {
        return [
            'short_link_id' => ShortLink::factory(),
            'ip_address' => fake()->ipv4(),
            'created_at' => fake()->dateTimeBetween('-30 days'),
            'updated_at' => now(),
        ];
    }
}
