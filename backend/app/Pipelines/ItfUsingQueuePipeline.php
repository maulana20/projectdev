<?php

namespace App\Pipelines;

use Closure;

use App\Enums\Reason\CodeEnum;

class ItfUsingQueuePipeline
{
    public function __invoke($hosttohost, Closure $next)
    {
        $interface = null;
        $i = 0;
        while (is_null($interface)) {
            $i++;
            if ($i >= 15) {
                $hosttohost->traffics()->create([ "reason_code" => CodeEnum::CRITICAL ]);
                break;
            }
            $interface = $hosttohost->interfaces()->free()->active()->orderUsedAt()->first();
            if (is_null($interface) && $i === 2) {
                $hosttohost->traffics()->create([ "reason_code" => CodeEnum::WARNING ]);
                sleep(2);
            }
        }
        return $next($interface);
    }
}