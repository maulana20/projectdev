<?php

namespace App\Actions\Transaction\Hosttohost;

class FareAction extends BaseAction
{
    public function fare($data)
    {
        if ($this->service->queue) $this->itfUsingRepository->take($this->interface); 
        $this->service->start($this->interface);
        $result = $this->service->fare($data);
        $this->itfUsingRepository->release($this->interface);
        return $result;
    }
}