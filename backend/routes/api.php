<?php

use Illuminate\Support\Facades\Route;

Route::get("/", fn () => response("Ticket Reservation API V1", 200));

Route::group([
    "prefix"  => "transaction",
], function () {
    Route::group([
        "prefix"     => "{hosttohost_identifier}",
        "whereIn"    => [
            "hosttohost_identifier" => [
                \App\Enums\Hosttohost\IdentifierEnum::AIRASIA,
                \App\Enums\Hosttohost\IdentifierEnum::LION
            ]
        ],
        "controller" => \App\Http\Controllers\Api\Transaction\HosttohostController::class,
    ], function () {
        Route::post("search", "search");
        Route::post("fare", "fare");
        Route::post("booking", "booking");
        Route::post("ticketing", "ticketing");
        Route::post("cancel", "cancel");
    });
});