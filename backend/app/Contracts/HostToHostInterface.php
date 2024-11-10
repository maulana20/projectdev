<?php

namespace App\Contracts;

interface HostToHostInterface
{
    public function search($request) : array;
    public function fare($request) : array;
    public function booking($request) : array;
    public function testBooking($request) : array;
    public function ticketing($request) : array;
    public function cancel($request) : array;
    public function reprint($request) : array;
}