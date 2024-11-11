<?php

namespace App\Actions\Transaction\Hosttohost;

use App\Helpers\HosttohostHelper;

class FareAction
{
    protected $service;

    public function __construct(HosttohostHelper $hosthostHelper)
    {
        $service = $hosthostHelper->getService();
        $this->service = new $service();
    }

    public function fare($data)
    {
        $this->service->start("interface");
        return $this->service->fare($data);
    }
}