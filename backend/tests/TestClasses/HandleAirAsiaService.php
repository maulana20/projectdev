<?php

namespace Tests\TestClasses;

use App\Abstracts\HostToHostAbstract;

class HandleAirAsiaService extends HostToHostAbstract
{
    protected function createClient() : void
    {
        $this->client = new \GuzzleHttp\Client();
    }

    protected function loginClient($interface) : void
    {}

    protected function logoutClient() : void
    {}

    protected function isSessionTimeout() : bool
    {
        return true;
    }
}