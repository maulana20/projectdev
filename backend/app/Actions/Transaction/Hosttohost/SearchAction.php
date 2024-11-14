<?php

namespace App\Actions\Transaction\Hosttohost;

class SearchAction extends BaseAction
{
    public function search($data)
    {
        if ($this->service->queue) $this->itfUsingRepository->take($this->interface); 
        $this->service->start($this->interface);
        $result = $this->service->search($data);
        $this->itfUsingRepository->release($this->interface);
        return $result;
    }
}