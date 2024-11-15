<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;
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
        //  "used_at"       => Carbon::now()->subMinutes(3), conditional check under minutes, already handle condition nullable value
        ]);
    }

    public function traffic(): static
    {
        return $this->state(fn (array $attributes) => [
            "used_at"       => Carbon::now(),
        ]);
    }
}
