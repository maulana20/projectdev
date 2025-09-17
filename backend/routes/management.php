<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Management\SettingController;

Route::group(["prefix" => "settings", "middleware" => "auth"], function ($router) {
    Route::get("/", [SettingController::class, "index"])->name('settings.index');
    Route::put("/", [SettingController::class, "update"])->name('settings.update');
});