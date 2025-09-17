<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::UpdateOrCreate(["name" => "purchase_request"], [
            "conversion"    => "object",
            "default_value" => ["roles" => [], "users" => []]
        ]);
        Setting::UpdateOrCreate(["name" => "theme"], [
            "conversion"    => "intval",
            "default_value" => 1
        ]);
    }
}
