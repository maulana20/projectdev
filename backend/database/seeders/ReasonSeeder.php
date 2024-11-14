<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\Reason\CodeEnum;
use App\Models\Reason;

class ReasonSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            CodeEnum::WARNING  => "still on queue",
            CodeEnum::CRITICAL => "critical issue",
            CodeEnum::DEPOSIT  => "error code (10)",
        ] as $code => $information) {
            $reason = Reason::firstOrNew(["code" => $code]);
            $reason->information = $information;
            $reason->save();
        }
    }
}