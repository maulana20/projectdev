<?php

namespace App\Abstracts;

use App\Traits\ClientDBTrait;

abstract class HostToHostAbstract
{
    use ClientDBTrait;

    public $client;

    abstract public function createClient();
    abstract protected function loginClient($interface) : void;
    abstract protected function logoutClient() : void;
    abstract protected function isSessionTimeout() : bool;

    protected function initClient($interface) : void
    {
        $this->client = $this->createClient();
        $this->loginClient($interface);
        $this->saveToDB($interface);
    }

    public function start($interface) : void
    {
        if (!$this->getFromDB($interface)) {
            $this->initClient($interface);
        } elseif ($this->isSessionTimeout()) {
            $this->initClient($interface);
        }
    }

    public function stop($interface) : void
    {
        $this->logoutClient();
        $interface->deleteFromDB($interface);
    }
}