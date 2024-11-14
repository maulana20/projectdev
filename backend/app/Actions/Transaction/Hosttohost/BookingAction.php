<?php

namespace App\Actions\Transaction\Hosttohost;

class BookingAction extends BaseAction
{
    public function booking($data)
    {
        if ($this->service->queue) $this->itfUsingRepository->take($this->interface); 
        $this->service->start($this->interface);
        $result = $this->service->booking($data);
        $this->itfUsingRepository->release($this->interface);
        return $result;
    }
}