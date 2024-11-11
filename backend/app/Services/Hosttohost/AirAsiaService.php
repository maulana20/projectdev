<?php

namespace App\Services\Hosttohost;

use App\Abstracts\HosttohostAbstract;
use App\Contracts\HosttohostInterface;

class AirAsiaService extends HosttohostAbstract implements HosttohostInterface
{
    protected function createClient() : void
    {}

    protected function loginClient($interface) : void
    {}

    protected function logoutClient() : void
    {}

    protected function isSessionTimeout() : bool
    {
        return true;
    }

    public function search($request) : array
    {
        return [];
    }

    public function fare($request) : array
    {
        return [];
    }

    public function booking($request) : array
    {
        return [];
    }

    public function testBooking($request) : array
    {
        return [];
    }

    public function ticketing($request) : array
    {
        return [];
    }

    public function cancel($request) : array
    {
        return [];
    }

    public function reprint($request) : array
    {
        return [];
    }
}