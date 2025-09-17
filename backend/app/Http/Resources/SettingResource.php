<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "id"            => $this->id,
            "name"          => $this->name,
            "conversion"    => $this->conversion,
            "value"         => $this->value,
            "default_value" => $this->default_value
        ];
    }
}