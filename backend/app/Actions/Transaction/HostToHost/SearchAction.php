<?php

namespace App\Actions\Transaction\HostToHost;

use App\Helpers\HostToHostHelper;

class SearchAction
{
    protected $service;

    public function __construct(HostToHostHelper $hosthostHelper)
    {
        $service = $hosthostHelper->getService();
        $this->service = new $service();
    }

    public function search($data)
    {
        $this->service->start("interface");
        return $this->service->search($data);
    }
}