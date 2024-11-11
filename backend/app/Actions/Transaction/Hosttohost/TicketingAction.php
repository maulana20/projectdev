<?php

namespace App\Actions\Transaction\Hosttohost;

use App\Helpers\HosttohostHelper;

class TicketingAction
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
        return $this->service->ticketing($data);
    }
}