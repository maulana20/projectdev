<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Enums\StatusEnum;

class ItfFactory extends Factory
{
    public function definition(): array
    {
        return [
            "hosttohost_id" => 1,
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
            "hosttohost_id" => 2,
            "url"           => "https://www.lion.com",
        //  "used_at"       => Carbon::now()->subMinutes(3), conditional check under minutes, already handle condition nullable value
        ]);
    }
}
