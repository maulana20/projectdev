<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Pipeline;
use App\Helpers\HosttohostHelper;
use App\Pipelines\ItfUsingNoQueuePipeline;
use App\Pipelines\ItfUsingQueuePipeline;
use App\Enums\UsingEnum;

class ItfUsingRepository
{
    public function free($queue = false)
    {
        $hosttohost = (new HosttohostHelper(request()->hosttohost_interface))->getHosttohost();
        return Pipeline::send($hosttohost)
            ->through([ $queue ? ItfUsingQueuePipeline::class : ItfUsingNoQueuePipeline::class ])
            ->thenReturn();
    }

    public function take($interface)
    {
        $interface->update([
            "using"    => UsingEnum::YES,
            "last_use" => time(),
        ]);
    }

    public function release($interface)
    {
        $interface->update([
            "using"    => UsingEnum::NO,
            "last_use" => time(),
        ]);
    }
}