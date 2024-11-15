<?php

namespace Tests\TestClasses;

use App\Abstracts\HostToHostAbstract;

class HandleLionService extends HostToHostAbstract
{
    public $queue = true;

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

    public function search($request) : array
    {
        return [
            [
                "route"     => "JKT-JOG",
                "date"      => "2022-08-17",
                "schedules" => [],
            ]
        ];
    }
}