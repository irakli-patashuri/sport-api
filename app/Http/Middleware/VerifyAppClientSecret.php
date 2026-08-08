<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Rejects any request that doesn't carry the NETSPOR app's shared secret in
 * a custom header. This is NOT user authentication (that's still
 * auth:sanctum on top, per-route) — it runs first, on every /api/v1 route,
 * so opening an endpoint directly in a browser (or any other client that
 * doesn't know the secret) gets a 403 before Sanctum or a controller ever
 * sees the request.
 *
 * Honest limitation: the secret ships inside the compiled NETSPOR app
 * (EXPO_PUBLIC_* env vars are bundled into client JS, not hidden), so this
 * stops casual link-opening / browsing / naive scraping — it does not stop
 * someone who deliberately decompiles the app and extracts the value. If
 * that threat model matters later, look at short-lived signed requests or
 * a per-device Sanctum token issued at first launch instead of a single
 * static shared secret.
 */
class VerifyAppClientSecret
{
    public function handle(Request $request, Closure $next)
    {
        $expected = config('app.client_secret');

        // Fail closed: if the server-side secret isn't configured, treat
        // every request as unauthorized rather than silently letting
        // everything through because of a missed .env entry.
        if (! is_string($expected) || $expected === '') {
            return response()->json([
                'error' => 'server_misconfigured',
                'message' => 'APP_CLIENT_SECRET is not set on the server.',
            ], 500);
        }

        $provided = $request->header('X-App-Secret', '');

        if (! is_string($provided) || $provided === '' || ! hash_equals($expected, $provided)) {
            return response()->json([
                'error' => 'forbidden',
                'message' => 'This endpoint is only reachable from the NETSPOR app.',
            ], 403);
        }

        return $next($request);
    }
}
