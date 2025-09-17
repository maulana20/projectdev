<?php

namespace Tests\Feature\Management;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SettingTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index_returns_all()
    {
        $user     = User::factory()->create();
        $settings = Setting::factory()->count(3)->create();
        $this->actingAs($user)->getJson(route("settings.index"))
            ->assertOk()
            ->assertJsonFragment(['id' => $settings[0]->id]);
    }

    public function test_update_data_bulk_object_has_successufully(): void
    {
        $user    = User::factory()->create();
        $setting = Setting::factory()->object()->create();
        $this->actingAs($user)->put(route("settings.update"), [
            "bulk" => [[
                "id"    => $setting->id,
                "value" => ["roles" => ["1"], "users" => ["2"]]
            ]]
        ])->assertNoContent();
        $this->actingAs($user)->getJson(route("settings.index"))
            ->assertOk()
            ->assertJsonFragment([
                "id"    => $setting->id,
                "value" => ["roles" => ["1"], "users" => ["2"]]
            ]);
    }
}