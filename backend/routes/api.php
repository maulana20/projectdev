<?php

use Illuminate\Support\Facades\Route;

Route::get("/", fn () => response("Ticket Reservation API V1", 200));

Route::group([
    "prefix"  => "transaction",
], function () {
    Route::group([
        "prefix"     => "{hosttohost_identifier}",
        "whereIn"    => [ "hosttohost_identifier" => ["airasia", "lion"] ],
        "controller" => \App\Http\Controllers\Api\Transaction\HostToHostController::class,
    ], function () {
        Route::post("search", "search");
        Route::post("fare", "fare");
        Route::post("booking", "booking");
        Route::post("ticketing", "ticketing");
        Route::post("cancel", "cancel");
    });
});