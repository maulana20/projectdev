<?php

namespace App\Actions\Transaction\HostToHost;

use App\Helpers\HostToHostHelper;

class BookingAction
{
    protected $service;

    public function __construct(HostToHostHelper $hosthostHelper)
    {
        $service = $hosthostHelper->getService();
        $this->service = new $service();
    }

    public function booking($data)
    {
        $this->service->start("interface");
        return $this->service->booking($data);
    }
}