<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\HostToHost\IdentifierEnum;
use App\Enums\HostToHost\IOEnum;
use App\Enums\StatusEnum;
use App\Models\Hosttohost;

class HosttohostSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            [
                "identifier"  => IdentifierEnum::AIRASIA,
                "io"          => IOEnum::AIRLINES,
                "name"        => "AirAsia",
                "description" => "masih dalam pengembangan",
                "priority"    => 1,
                "status"      => StatusEnum::ACTIVE,
            ],
            [
                "identifier"  => IdentifierEnum::LION,
                "io"          => IOEnum::AIRLINES,
                "name"        => "Lion Air",
                "description" => "masih dalam pengembangan",
                "priority"    => 2,
                "status"      => StatusEnum::ACTIVE,
            ],
        ] as $data) {
            $hosttohost = Hosttohost::firstOrNew([
                "identifier" => $data["identifier"],
                "io"         => $data["io"]
            ]);
            $hosttohost->name        = $data["name"];
            $hosttohost->description = $data["description"];
            $hosttohost->priority    = $data["priority"];
            $hosttohost->status      = $data["status"];
            $hosttohost->save();
        }
    }
}