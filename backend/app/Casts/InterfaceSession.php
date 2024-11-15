<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Laravel\SerializableClosure\SerializableClosure;

class InterfaceSession implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $attributes = $this->setAttributes($attributes, $model);
        if ($this->isFileExists($attributes)) {
            $serialize = file_get_contents(Storage::disk("public")->path($this->getPathFile($attributes)));
            $closure   = unserialize($serialize)->getClosure();
            return $closure();
        }
        return "";
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $attributes = $this->setAttributes($attributes, $model);
        if ($value) {
            SerializableClosure::setSecretKey("secret");
            $serialize = serialize(new SerializableClosure(fn () => $value));
            return Storage::disk("public")->put($this->getPathFile($attributes), $serialize);
        } else {
            if ($attributes["session"]) Storage::disk("public")->delete($this->getPathFile($attributes));
            return "";
        }
    }

    public function setAttributes($attributes, $model)
    {
        return array_replace($attributes, [
            "hosttohost_identifier" => $model->hosttohost->identifier,
            "session"               => $model->session ?? "",
        ]);
    }
    
    private function getPathFile($attributes)
    {
        return sprintf("interface/%s/interface-%s.dat", $attributes["hosttohost_identifier"], $attributes["id"]);
    }

    private function isFileExists($attributes)
    {
        return $attributes["session"] && file_exists(Storage::disk("public")->path($attributes["session"]));
    }
}