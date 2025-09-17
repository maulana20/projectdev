<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Resources\MeResource;

Route::group(["middleware" => "guest"], function ($router) {
    Route::post("/register", [RegisteredUserController::class, "store"])->name("register");
    Route::post("/login", [AuthenticatedSessionController::class, "store"])->name("login");
    Route::post("/forgot-password", [PasswordResetLinkController::class, "store"])->name("password.email");
    Route::post("/reset-password", [NewPasswordController::class, "store"])->name("password.store");
});

Route::group(["middleware" => "auth"], function ($router) {
    Route::get("/me", fn (Request $request) => response()->json(new MeResource($request->user())))->name("me");
    Route::get("/verify-email/{id}/{hash}", VerifyEmailController::class)->middleware(["signed", "throttle:6,1"])->name("verification.verify");
    Route::post("/email/verification-notification", [EmailVerificationNotificationController::class, "store"])->middleware(["throttle:6,1"])->name("verification.send");
    Route::post("/logout", [AuthenticatedSessionController::class, "destroy"])->name("logout");
});