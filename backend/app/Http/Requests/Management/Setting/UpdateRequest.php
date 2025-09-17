<?php

namespace App\Http\Requests\Management\Setting;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Setting;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $settings = Setting::all();
        return [
            "bulk"         => "array|present",
            "bulk.*.id"    => "integer",
            "bulk.*.value" => function ($attribute, $value, $fail) use ($settings) {
                $index = explode(".", $attribute)[1];
                if ($setting = collect($settings)->firstWhere("id", "=", $this->bulk[$index]["id"])) {
                    if ($setting->type === "object") {
                        foreach (array_keys($setting->default_value) as $key) {
                            if (gettype($setting->default_value[$key]) !== gettype($this->bulk[$index]["value"][$key])) {
                                $fail("The {$attribute}.{$key}" . " field must be an " . gettype($setting->default_value[$key]));
                            }
                        }
                    } else {
                        if (gettype($setting->default_value) !== gettype($this->bulk[$index]["value"])) {
                            $fail("The {$attribute}" . " field must be an " . gettype($setting->default_value));
                        }
                    }
                }
            }
        ];
    }
}