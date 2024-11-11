<?php

namespace Tests\TestClasses;

use App\Abstracts\HostToHostAbstract;

class HandleAirAsiaService extends HostToHostAbstract
{
    public function createClient()
    {
        $client = new \GuzzleHttp\Client();
        return $client;
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