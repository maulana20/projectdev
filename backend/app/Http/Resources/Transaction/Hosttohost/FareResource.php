<?php

namespace App\Http\Resources\Transaction\Hosttohost;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FareResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "publish" => $this["publish"],
            "tax"     => $this["tax"],
            "total"   => $this["total"],
            "nta"     => $this["nta"],
        ];
    }
}