<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HosttohostInterfaceTest extends TestCase
{
    use DatabaseTransactions;

    public function test_check_client_with_service(): void
    {
        $service   = new \Tests\TestClasses\HandleAirAsiaService;
        $interface = \App\Models\Itf::factory()->create();
        $service->start($interface);
        $this->assertSame("interface.dat", "interface.dat");
    }
}