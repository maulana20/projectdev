<?php

namespace App\Http\Resources\Transaction\Hosttohost;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "label"  => $this["label"],
            "value"  => $this["value"],
            "seat"   => $this["seat"],
            "status" => $this["status"],
        ];
    }
}