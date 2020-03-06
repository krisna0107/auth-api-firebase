<?php

namespace App\Http\Middleware;

use Closure;
use Kreait\Firebase\JWT\Error\IdTokenVerificationFailed;
use Kreait\Firebase\JWT\IdTokenVerifier;

class AuthFirebase
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->hasHeader('Authorization')) {
            return response()->json('Authorization Header not found', 401);
        }

        $token = $request->bearerToken();

        if($request->header('Authorization') == null || $token == null) {
            return response()->json('No token provided', 401);
        }

        $validation = $this->user($token);

        if ($validation !== true) 
        {
            return $validation;
        }

        return $next($request);
    }


    public function user($token)
    {
        $verifier = IdTokenVerifier::createWithProjectId("project-id-name");
        try {
            $token = $verifier->verifyIdToken($token);
            return true;
        }
        catch (\Exception $e) {
            return response()->json([
                "error_code" => "AUTH01",
                "message" => "Token tidak berlaku/expired"
            ], 400);
        }

        try {
            $token = $verifier->verifyIdTokenWithLeeway($token, $leewayInSeconds = 10000000);
        } catch (IdTokenVerificationFailed $e) {
            return response()->json([
                "error_code" => "AUTH01",
                "message" => "Token tidak berlaku/expired"
            ], 400);
        }
    }
}