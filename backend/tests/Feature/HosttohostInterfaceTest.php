<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HosttohostInterfaceTest extends TestCase
{
    use DatabaseTransactions;

    public function test_check_client_session_with_local_storage(): void
    {
        $service   = new \Tests\TestClasses\HandleAirAsiaService;
        $interface = \App\Models\Itf::factory()->create();
        $service->start($interface);
        $pathFile  = \Illuminate\Support\Facades\Storage::disk("public")->path("interface/airasia/interface-{$interface->id}.dat");
        $this->assertTrue(file_exists($pathFile));
        $service->stop($interface);
    }

    public function test_check_itf_using_no_queue_pipeline(): void
    {
        $interface = \App\Models\Itf::factory()->create();
        $pipeline  = \Illuminate\Support\Facades\Pipeline::send($interface->hosttohost)
            ->through([
                \App\Pipelines\ItfUsingNoQueuePipeline::class
            ])
            ->thenReturn();
        $only      = ["hosttohost_id", "name", "username", "password"];
        $this->assertSame(
            \Illuminate\Support\Arr::only($interface->toArray(), $only),
            \Illuminate\Support\Arr::only($pipeline->toArray(), $only)
        );
    }

    public function test_check_itf_using_queue_pipeline(): void
    {
        $interface = \App\Models\Itf::factory()->queue()->create();
        $pipeline  = \Illuminate\Support\Facades\Pipeline::send($interface->hosttohost)
            ->through([
                \App\Pipelines\ItfUsingQueuePipeline::class
            ])
            ->thenReturn();
        $only      = ["hosttohost_id", "name", "username", "password"];
        $this->assertSame(
            \Illuminate\Support\Arr::only($interface->toArray(), $only),
            \Illuminate\Support\Arr::only($pipeline->toArray(), $only)
        );
    }
}