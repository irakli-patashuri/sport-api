<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * Attach authenticated user when a valid Bearer token is present; otherwise continue.
 */
class OptionalSanctumAuth
{
    public function handle(Request $request, Closure $next)
    {
        $header = $request->header('Authorization', '');
        if (str_starts_with($header, 'Bearer ')) {
            $plain = trim(substr($header, 7));
            if ($plain !== '') {
                $accessToken = PersonalAccessToken::findToken($plain);
                if ($accessToken && $accessToken->tokenable) {
                    $request->setUserResolver(fn () => $accessToken->tokenable);
                }
            }
        }

        return $next($request);
    }
}
