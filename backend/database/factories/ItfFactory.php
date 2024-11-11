<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Hosttohost;

class ItfFactory extends Factory
{
    public function definition(): array
    {
        return [
            "hosttohost_id" => Hosttohost::factory()->create()->id,
            "name"          => fake()->name(),
            "username"      => fake()->username(),
            "password"      =>  Str::random(10),
            "url"           => "https://www.airasia.com",
        ];
    }
}
