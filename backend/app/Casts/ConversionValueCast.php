<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ConversionValueCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) return $value;
        return $attributes["conversion"] === "object" ? json_decode($value, true) : $attributes["conversion"]($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $attributes["conversion"] === "object" ? json_encode($value) : $value;
    }
}
