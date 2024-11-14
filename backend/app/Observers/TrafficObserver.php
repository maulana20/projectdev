<?php

namespace App\Observers;

use Exception;

use App\Enums\Reason\CodeEnum;
use App\Models\Traffic;

class TrafficObserver
{
    public function created(Traffic $traffic): void
    {
        if ($traffic->reason->code === CodeEnum::CRITICAL) throw new Exception($traffic->reason->information);
    }

    public function updated(Traffic $traffic): void
    {}

    public function deleted(Traffic $traffic): void
    {}

    public function restored(Traffic $traffic): void
    {}

    public function forceDeleted(Traffic $traffic): void
    {}
}
