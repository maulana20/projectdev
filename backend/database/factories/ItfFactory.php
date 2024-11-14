<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Enums\StatusEnum;
use App\Models\Hosttohost;

class ItfFactory extends Factory
{
    public function definition(): array
    {
        return [
            "hosttohost_id" => Hosttohost::factory()->create()->id,
            "name"          => fake()->name(),
            "username"      => fake()->username(),
            "password"      => Str::random(10),
            "url"           => "https://www.airasia.com",
            "status"        => StatusEnum::ACTIVE,
        ];
    }

    public function queue(): static
    {
        return $this->state(fn (array $attributes) => [
            "hosttohost_id" => Hosttohost::factory()->queue()->create()->id,
            "url"           => "https://www.lion.com",
            "last_use"      => time() - 360,
        ]);
    }

    public function traffic(): static
    {
        return $this->state(fn (array $attributes) => [
            "last_use"      => time(),
        ]);
    }
}
