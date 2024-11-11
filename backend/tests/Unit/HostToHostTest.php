<?php

namespace Tests\Uniy;

use PHPUnit\Framework\TestCase;

class HosttohostTest extends TestCase
{
    public function test_check_service_with_interface(): void
    {
        $this->assertSame(\App\Services\Hosttohost\AirAsiaService::class, (new \App\Helpers\HosttohostHelper("airasia"))->getService());
        $this->assertInstanceOf(\App\Contracts\HosttohostInterface::class, new \App\Services\Hosttohost\AirAsiaService);
        $this->assertInstanceOf(\App\Abstracts\HosttohostAbstract::class, new \App\Services\Hosttohost\AirAsiaService);
        try {
            (new \App\Helpers\HosttohostHelper("xxx"))->getService();
        } catch (\Exception $e) {
            $this->assertSame($e->getMessage(), "hostohost not exists.");
        }
    }

    public function test_check_client_with_service(): void
    {
        $service = \Mockery::mock(\App\Services\Hosttohost\AirAsiaService::class)->makePartial();
        $service->shouldReceive("createClient")
            ->withAnyArgs()
            ->andReturn(new \GuzzleHttp\Client);
        $this->assertSame(get_class($service->createClient()), \GuzzleHttp\Client::class);
    }
}