<?php

namespace App\Actions\Transaction\Hosttohost;

use App\Helpers\HosttohostHelper;

class CancelAction
{
    protected $service;

    public function __construct(HosttohostHelper $hosthostHelper)
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