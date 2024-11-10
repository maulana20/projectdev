<?php

namespace App\Http\Resources\Transaction\HostToHost;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id"            => $this["id"],
            "code"          => $this["code"],
            "name"          => $this["name"],
            "time_depart"   => $this["time_depart"],
            "time_arrive"   => $this["time_arrive"],
            "direct_transit"=> $this["direct_transit"],
            "classes"       => ClassResource::collection($this["classes"])
        ];
    }
}