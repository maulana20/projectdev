<?php

namespace App\Actions\Transaction\Hosttohost;

class TicketingAction extends BaseAction
{
    public function ticketing($data)
    {
        if ($this->service->queue) $this->itfUsingRepository->take($this->interface); 
        $this->service->start($this->interface);
        $result = $this->service->ticketing($data);
        $this->itfUsingRepository->release($this->interface);
        return $result;
    }
}