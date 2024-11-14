<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\GuzzleHttp\Exception\GuzzleException $e, Request $request) {
            if ($e instanceof \GuzzleHttp\Exception\ClientException || $e instanceof \GuzzleHttp\Exception\RequestException) {
                $response = $e->getResponse();
                $error = json_decode($response->getBody()->getContents(), true);
                $message = "An error of http has occurred";
                foreach (["errorMessage", "error", "message"] as $key) {
                    if (isset($error[$key])) {
                        $message = $error[$key];
                        break;
                    }
                }
                return response()->json([
                    "message" => $message,
                ], 400);
            }
            if ($e instanceof \GuzzleHttp\Exception\ConnectException) {
                return response()->json([
                    "message" => "An error of http has occurred",
                ], 500);
            }
        });
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->wantsJson() || $request->ajax()) {
                if ($e->getPrevious() instanceof ModelNotFoundException) {
                    $message = "Not Found";
                } else {
                    $message = $e->getMessage() ? $e->getMessage() : "Not Found";
                }
                return response()->json([
                    "message" => $message,
                ], 404);
            }
        });
        $exceptions->render(function (HttpException $e, Request $request) {
            if ($request->wantsJson() || $request->ajax()) {
                $message = match ($e->getStatusCode()) {
                    401 => "Unauthorized",
                    403 => "Forbidden",
                    404 => "Not Found",
                };
                if ($message) {
                    return response()->json([
                        "message" => $e->getMessage() ? $e->getMessage() : $message,
                    ], $e->getStatusCode());
                }
            }
        });
    })->create();
