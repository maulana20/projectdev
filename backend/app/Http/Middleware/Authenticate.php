<?php

namespace App\Http\Middleware;

use App;
use Auth;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class Authenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        $decode = $this->decode($request->bearerToken());
        $data = $this->user($decode->sub);
        $user = User::where("email", "=", $data["email_addresses"][0]["email_address"])->first();
        if (!$user) App::abort(401);
        Auth::login($user);
        return $next($request);
    }

    private function decode($token)
    {
        try {
            $pem = file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . "/../../pem");
            return JWT::decode($token, new Key($pem, "RS256"));
        } catch (Exception $e) {}
        App::abort(401);
    }

    private function user($id)
    {
        try {
            $response = Http::withHeaders(['Authorization' => "Bearer " .  env("CLERK_CLIENT_SECRET")])
                ->get("https://api.clerk.com/v1/users/{$id}");
        } catch (Exception $e) {
            App::abort(401);
        }
        return $response->json();
    }
}