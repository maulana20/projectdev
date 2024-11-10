<?php

namespace App\Http\Resources\Transaction\HostToHost;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "route"     => $this["route"],
            "date"      => $this["date"],
            "schedules" => ScheduleResource::collection($this["schedules"]),
        ];
    }
}
