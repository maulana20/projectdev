<?php

namespace App\Actions\Transaction\Hosttohost;

use App\Helpers\HosttohostHelper;
use App\Repositories\ItfUsingRepository;

class BaseAction
{
    protected $service;
    protected $interface;

    public function __construct(
        protected ItfUsingRepository $itfUsingRepository,
        HosttohostHelper $hosthostHelper
    )
    {
        $service = $hosthostHelper->getService();
        $this->service = new $service();
        $this->interface = $this->itfUsingRepository->free($this->service->queue);
    }
}