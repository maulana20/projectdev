<?php

namespace App\Http\Resources\Transaction\Hosttohost;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "code"       => $this["code"],
            "name"       => $this["name"],
            "time_limit" => $this["time_limit"],
            "segment"    => $this["segment"],
            "publish"    => $this["publish"],
            "tax"        => $this["tax"],
            "total"      => $this["total"],
            "nta"        => $this["nta"],
        ];
    }
}