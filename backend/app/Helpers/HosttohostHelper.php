<?php

namespace App\Helpers;

use Exception;

use App\Enums\Hosttohost\IdentifierEnum;
use App\Enums\StatusEnum;
use App\Models\Hosttohost;
use App\Services\Hosttohost\AirAsiaService;
use App\Services\Hosttohost\LionService;

class HosttohostHelper
{
    protected const HOSTTOHOSTS = [
        IdentifierEnum::AIRASIA => AirAsiaService::class,
        IdentifierEnum::LION    => LionService::class
    ];

    protected $hosttohost_identifier;

    protected function identifierByPath()
    {
        $hosttohost_identifier = request()->route()->parameter("hosttohost_identifier") ?? null;
        if (is_null($hosttohost_identifier)) {
            $path = explode("/", request()->path());
            if (isset($path[2]) && array_key_exists($path[2], static::HOSTTOHOSTS)) {
                $hosttohost_identifier = $path[2];
                request()->route()->setParameter("hosttohost_identifier", $hosttohost_identifier);
            }
        }
        return $hosttohost_identifier;
    }

    public function __construct($hosttohost_identifier = null)
    {
        $this->hosttohost_identifier = is_null($hosttohost_identifier) ? $this->identifierByPath() : $hosttohost_identifier;
        if (!array_key_exists($this->hosttohost_identifier, static::HOSTTOHOSTS)) throw new Exception("hostohost not exists.");
    }

    public function getService()
    {
        return static::HOSTTOHOSTS[$this->hosttohost_identifier];
    }

    public function getHosttohost()
    {
        $hosttohost = Hosttohost::identifier($this->hosttohost_identifier)->first();
        if ($hosttohost->status === StatusEnum::INACTIVE) throw new Exception($hosttohost->description);
        return $hosttohost;
    }
}