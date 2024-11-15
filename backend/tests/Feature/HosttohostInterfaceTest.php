<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HosttohostInterfaceTest extends TestCase
{
    use DatabaseTransactions;

    protected $interfaceNoQueue;
    protected $interfaceQueue;
    protected $payload;

    public function setUp(): void
    {
        parent::setUp();
        $this->interfaceNoQueue = \App\Models\Itf::factory()->create();
        $this->interfaceQueue   = \App\Models\Itf::factory()->queue()->create();
        $this->payload          = [
            "origin"      => "CGK",
            "destination" => "JOG",
            "type"        => "OW",
            "from_date"   => "2022-08-17",
            "to_date"     => "2022-08-17",
            "adult"       => 1,
            "child"       => 0,
            "infant"      => 0
        ];
    }

    public function test_check_client_session_with_local_storage(): void
    {
        $service  = new \Tests\TestClasses\HandleAirAsiaService;
        $service->start($this->interfaceNoQueue);
        $pathFile = \Illuminate\Support\Facades\Storage::disk("public")->path("interface/airasia/interface-{$this->interfaceNoQueue->id}.dat");
        $this->assertTrue(file_exists($pathFile));
        $service->stop($this->interfaceNoQueue);
    }

    public function test_check_itf_using_no_queue_pipeline(): void
    {
        $pipeline = \Illuminate\Support\Facades\Pipeline::send($this->interfaceNoQueue->hosttohost)
            ->through([
                \App\Pipelines\ItfUsingNoQueuePipeline::class
            ])
            ->thenReturn();
        $only     = ["hosttohost_id", "name", "username", "password"];
        $this->assertSame(
            \Illuminate\Support\Arr::only($this->interfaceNoQueue->toArray(), $only),
            \Illuminate\Support\Arr::only($this->interfaceNoQueue->toArray(), $only)
        );
    }

    public function test_check_itf_using_queue_pipeline(): void
    {
        $pipeline = \Illuminate\Support\Facades\Pipeline::send($this->interfaceQueue->hosttohost)
            ->through([
                \App\Pipelines\ItfUsingQueuePipeline::class
            ])
            ->thenReturn();
        $only     = ["hosttohost_id", "name", "username", "password"];
        $this->assertSame(
            \Illuminate\Support\Arr::only($this->interfaceQueue->toArray(), $only),
            \Illuminate\Support\Arr::only($this->interfaceQueue->toArray(), $only)
        );
    }

    public function test_check_itf_using_queue_traffic_pipeline(): void
    {
        $this->interfaceQueue->update([ "used_at" => \Carbon\Carbon::now() ]);

        try {
            \Illuminate\Support\Facades\Pipeline::send($this->interfaceQueue->hosttohost)
                ->through([
                    \App\Pipelines\ItfUsingQueuePipeline::class
                ])
                ->thenReturn();
        } catch (\Exception $e) {
            $this->assertSame($e->getMessage(), "critical issue");
        }
    }

    public function test_check_itf_using_no_queue_with_response_service(): void
    {
        $this->mock(\App\Helpers\HosttohostHelper::class)
            ->shouldReceive("getService")
            ->andReturn(\Tests\TestClasses\HandleAirAsiaService::class);

        $this->postJson("api/transaction/{$this->interfaceNoQueue->hosttohost->identifier}/search", $this->payload)
            ->assertJson([
                "data" => [
                    [
                        "route"     => "JKT-JOG",
                        "date"      => "2022-08-17",
                        "schedules" => [],
                    ]
                ]
            ]);

        $this->assertFalse(boolval($this->interfaceNoQueue->fresh()->using));
    }

    public function test_check_itf_using_queue_with_response_service(): void
    {
        $this->interfaceQueue->update([ "used_at" => \Carbon\Carbon::now()->subMinutes(3), "using" => \App\Enums\UsingEnum::NO ]);

        $this->mock(\App\Helpers\HosttohostHelper::class)
            ->shouldReceive("getService")
            ->andReturn(\Tests\TestClasses\HandleLionService::class);

        $this->postJson("api/transaction/{$this->interfaceQueue->hosttohost->identifier}/search", $this->payload)
            ->assertJson([
                "data" => [
                    [
                        "route"     => "JKT-JOG",
                        "date"      => "2022-08-17",
                        "schedules" => [],
                    ]
                ]
            ]);

        $this->assertFalse(boolval($this->interfaceQueue->fresh()->using));
    }
}