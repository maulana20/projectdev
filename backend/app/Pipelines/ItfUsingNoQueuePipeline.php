<?php

namespace App\Pipelines;

use Closure;
use Log;

class ItfUsingNoQueuePipeline
{
    public function __invoke($hosttohost, Closure $next)
    {
        $interface  = $hosttohost->interfaces()->active()->first();
        if (!$interface) Log::info("critical", [ "hosttohost" => $hosttohost->name ]);
        return $next($interface);
    }
}