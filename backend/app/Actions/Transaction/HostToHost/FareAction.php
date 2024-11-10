<?php

namespace App\Actions\Transaction\HostToHost;

use App\Helpers\HostToHostHelper;

class FareAction
{
    protected $service;

    public function __construct(HostToHostHelper $hosthostHelper)
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