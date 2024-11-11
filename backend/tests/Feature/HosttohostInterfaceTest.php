<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HosttohostInterfaceTest extends TestCase
{
    use DatabaseTransactions;

    public function test_check_client_session_with_local_storage(): void
    {
        $service   = new \Tests\TestClasses\HandleAirAsiaService;
        $interface = \App\Models\Itf::factory()->create();
        $service->start($interface);
        $pathFile  = Storage::disk("public")->path("interface/airasia/interface-{$interface->id}.dat");
        $this->assertTrue(file_exists($pathFile));
        $service->stop($interface);
    }
}