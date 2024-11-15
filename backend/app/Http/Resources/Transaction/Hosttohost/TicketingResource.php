<?php

namespace App\Http\Resources\Transaction\Hosttohost;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "confirm"    => $this["confirm"],
        ];
    }
}