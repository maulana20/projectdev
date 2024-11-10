<?php

namespace Tests\Uniy;

use PHPUnit\Framework\TestCase;

class HostToHostTest extends TestCase
{
    public function test_check_service_with_interface(): void
    {
        $this->assertSame(\App\Services\HostToHost\AirAsiaService::class, (new \App\Helpers\HostToHostHelper("airasia"))->getService());
        $this->assertInstanceOf(\App\Contracts\HostToHostInterface::class, new \App\Services\HostToHost\AirAsiaService);
        $this->assertInstanceOf(\App\Abstracts\HostToHostAbstract::class, new \App\Services\HostToHost\AirAsiaService);
        try {
            (new \App\Helpers\HostToHostHelper("xxx"))->getService();
        } catch (\Exception $e) {
            $this->assertSame($e->getMessage(), "hostohost not exists.");
        }
    }

    public function test_check_client_with_service(): void
    {
        $service = \Mockery::mock(\App\Services\HostToHost\AirAsiaService::class)->makePartial();
        $service->shouldReceive("createClient")
            ->withAnyArgs()
            ->andReturn(new \GuzzleHttp\Client);
        $this->assertSame(get_class($service->createClient()), \GuzzleHttp\Client::class);
    }
}
