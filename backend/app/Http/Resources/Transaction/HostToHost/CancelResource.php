<?php

namespace App\Http\Resources\Transaction\HostToHost;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CancelResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "confirm"    => $this["confirm"],
        ];
    }
}
