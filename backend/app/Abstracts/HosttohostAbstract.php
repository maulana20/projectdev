<?php

namespace App\Abstracts;

use App\Traits\ClientDBTrait;

abstract class HosttohostAbstract
{
    protected $client;

    public $queue = false;

    abstract protected function createClient() : void;
    abstract protected function loginClient($interface) : void;
    abstract protected function logoutClient() : void;
    abstract protected function isSessionTimeout() : bool;

    protected function startClient($interface) : void
    {
        $this->createClient();
        $this->loginClient($interface);
        $interface->update([ "session" => $this->client ]);
    }

    protected function isSession($interface) : bool
    {
        if ($interface->session) {
            $this->client = $interface->session;
            return true;
        }
        return false;
    }

    public function start($interface) : void
    {
        if (!$this->isSession($interface)) {
            $this->startClient($interface);
        } elseif ($this->isSessionTimeout()) {
            $this->startClient($interface);
        }
    }

    public function stop($interface) : void
    {
        $this->logoutClient();
        $interface->update([ "session" => "" ]);
    }
}