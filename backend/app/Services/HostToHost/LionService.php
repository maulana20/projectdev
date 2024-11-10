<?php

namespace App\Services\HostToHost;

use App\Abstracts\HostToHostAbstract;
use App\Contracts\HostToHostInterface;

class LionService extends HostToHostAbstract implements HostToHostInterface
{
    public function createClient()
    {}

    protected function loginClient($interface)
    {}

    protected function logoutClient()
    {}

    protected function isSessionTimeout()
    {}

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