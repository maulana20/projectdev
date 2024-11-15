<?php

namespace App\Pipelines;

use Closure;

use App\Enums\Reason\CodeEnum;

class ItfUsingNoQueuePipeline
{
    public function __invoke($hosttohost, Closure $next)
    {
        $interface  = $hosttohost->interfaces()->active()->orderUsedAt()->first();
        if (!$interface) $hosttohost->traffics()->create([ "reason_code" => CodeEnum::CRITICAL ]);
        return $next($interface);
    }
}