<?php

namespace App\Pipelines;

use Closure;
use Log;

use App\Enums\StatusEnum;
use App\Helpers\HosttohostHelper;
use App\Models\Hosttohost;

class ItfUsingQueuePipeline
{
    public function __invoke($hosttohost, Closure $next)
    {
        $interface = null;
        $i = 0;
        while (is_null($interface)) {
            $i++;
            if ($i >= 15) {
                Log::info("critical", [ "hosttohost" => $hosttohost->name ]);
                break;
            }
            $interface = $hosttohost->interfaces()->free()->active()->first();
            if (is_null($interface) && $i === 2) {
                Log::info("critical", [ "hosttohost" => $hosttohost->name ]);
                sleep(2);
            }
        }
        return $next($interface);
    }
}