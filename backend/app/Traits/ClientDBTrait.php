<?php

namespace App\Traits;

trait ClientDBTrait
{
    protected function saveToDB($interface) : void
    {}

    protected function getFromDB($interface) : string
    {
        return "interface.dat";
    }

    protected function deleteFromDB($interface) : void
    {}
}