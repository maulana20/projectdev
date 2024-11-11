<?php

namespace App\Actions\Transaction\Hosttohost;

use App\Helpers\HosttohostHelper;

class SearchAction
{
    protected $service;

    public function __construct(HosttohostHelper $hosthostHelper)
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