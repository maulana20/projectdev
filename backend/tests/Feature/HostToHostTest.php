<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HostToHostTest extends TestCase
{
    public function test_check_search_resource(): void
    {
        $payload = [
            "origin"      => "CGK",
            "destination" => "JOG",
            "type"        => "OW",
            "from_date"   => "2022-08-17",
            "to_date"     => "2022-08-17",
            "adult"       => 1,
            "child"       => 0,
            "infant"      => 0
        ];

        $data = [
            [
                "route"     => "JKT-JOG",
                "date"      => "2022-08-17",
                "schedules" => [
                    [
                        "id"             => 0,
                        "code"           => "Boeing 737-8",
                        "name"           => "Lion Air",
                        "time_depart"    => "2022-08-17 00:13:28.464732",
                        "time_arrive"    => "2022-08-17 00:13:28.464732",
                        "direct_transit" => 0,
                        "classes" => [
                            [
                                "label"  => "Y",
                                "value"  => "EYIdja78hjh",
                                "seat"   => 9,
                                "status" => 0
                            ]
                        ]
                    ]
                ]
            ]
        ];
        
        $this->mock(\App\Actions\Transaction\HostToHost\SearchAction::class)
            ->shouldReceive("search")
            ->andReturn($data);

        $this->postJson("api/transaction/airasia/search", $payload)
            ->assertJson([ "data" => $data ]);
    }

    public function test_check_fare_resource(): void
    {
        $payload = [
            "origin"      => "CGK",
            "destination" => "JOG",
            "date"        => "2022-08-17",
            "adult"       => 1,
            "child"       => 0,
            "infant"      => 0,
            "choices"     => [ "EYIdja78hjh" ]
        ];

        $data = [
            "publish" => (float) 100000,
            "tax"     => (float) 10000,
            "total"   => (float) 110000,
            "nta"     => (float) 98000,
        ];
        
        $this->mock(\App\Actions\Transaction\HostToHost\FareAction::class)
            ->shouldReceive("fare")
            ->andReturn($data);

        $this->postJson("api/transaction/airasia/fare", $payload)
            ->assertJson([ "data" => $data ]);
    }

    public function test_check_booking_resource(): void
    {
        $payload = [
            "origin"      => "CGK",
            "destination" => "JOG",
            "type"        => "OW",
            "from_date"   => "2022-08-17",
            "to_date"     => "2022-08-17",
            "adult"       => 1,
            "child"       => 0,
            "infant"      => 0,
            "choices"     => [
                "depart" => [ "EYIdja78hjh" ]
            ]
        ];

        $data = [
            "code"       => "XTGHFG",
            "name"       => "Lion Air",
            "time_limit" => "2022-08-17 00:13:28.464732",
            "segment"    => 1,
            "publish"    => (float) 100000,
            "tax"        => (float) 10000,
            "total"      => (float) 110000,
            "nta"        => (float) 98000,
        ];
        
        $this->mock(\App\Actions\Transaction\HostToHost\BookingAction::class)
            ->shouldReceive("booking")
            ->andReturn($data);

        $this->postJson("api/transaction/airasia/booking", $payload)
            ->assertJson([ "data" => $data ]);
    }

    public function test_check_ticketing_resource(): void
    {
        $payload = [ "code" => "XTGHFG" ];

        $data = [ "confirm" => true ];
        
        $this->mock(\App\Actions\Transaction\HostToHost\TicketingAction::class)
            ->shouldReceive("ticketing")
            ->andReturn($data);

        $this->postJson("api/transaction/airasia/ticketing", $payload)
            ->assertJson([ "data" => $data ]);
    }

    public function test_check_cancel_resource(): void
    {
        $payload = [ "code" => "XTGHFG" ];

        $data = [ "confirm" => true ];
        
        $this->mock(\App\Actions\Transaction\HostToHost\CancelAction::class)
            ->shouldReceive("cancel")
            ->andReturn($data);

        $this->postJson("api/transaction/airasia/cancel", $payload)
            ->assertJson([ "data" => $data ]);
    }
}