<?php

namespace App\Actions\Transaction\Hosttohost;

class CancelAction extends BaseAction
{
    public function ticketing($data)
    {
        if ($this->service->queue) $this->itfUsingRepository->take($this->interface); 
        $this->service->start($this->interface);
        $result = $this->service->cancel($data);
        $this->itfUsingRepository->release($this->interface);
        return $result;
    }
}