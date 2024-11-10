<?php

namespace App\Actions\Transaction\HostToHost;

use App\Helpers\HostToHostHelper;

class CancelAction
{
    protected $service;

    public function __construct(HostToHostHelper $hosthostHelper)
    {
        $service = $hosthostHelper->getService();
        $this->service = new $service();
    }

    public function ticketing($data)
    {
        $this->service->start("interface");
        return $this->service->cancel($data);
    }
}