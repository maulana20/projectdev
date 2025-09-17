<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    public function definition(): array
    {
        return [
            "name"          => fake()->name(),
            "conversion"    => "strval",
            "value"         => "string",
            "default_value" => "string"
        ];
    }

    public function object(): static
    {
        return $this->state(fn (array $attributes) => [
            "conversion"    => "object",
            "default_value" => ["roles" => [], "users" => []],
            "value"         => ["roles" => [], "users" => []]
        ]);
    }

    public function boolean(): static
    {
        return $this->state(fn (array $attributes) => [
            "conversion"    => "boolval",
            "default_value" => true,
            "value"         => true
        ]);
    }
}
