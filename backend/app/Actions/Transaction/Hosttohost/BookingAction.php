<?php

namespace App\Actions\Transaction\Hosttohost;

use App\Helpers\HosttohostHelper;

class BookingAction
{
    protected $service;

    public function __construct(HosttohostHelper $hosthostHelper)
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