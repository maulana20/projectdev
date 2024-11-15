<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\HostToHost\IdentifierEnum;
use App\Enums\HostToHost\IOEnum;
use App\Enums\StatusEnum;

class HosttohostFactory extends Factory
{
    public function definition(): array
    {
        return [
            "identifier"  => IdentifierEnum::AIRASIA,
            "io"          => IOEnum::AIRLINES,
            "name"        => fake()->name(),
            "description" => fake()->address(),
            "priority"    => 1,
            "status"      => StatusEnum::ACTIVE,
        ];
    }

    public function queue(): static
    {
        return $this->state(fn (array $attributes) => [
            "identifier"  => IdentifierEnum::LION,
        ]);
    }
}