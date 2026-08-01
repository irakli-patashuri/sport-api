<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Mobile auth API — response shapes match the former sport-node-api /api/auth/*
 * so NETSPOR can keep the same client contract (access_token + user).
 */
class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $first = trim((string) ($request->input('first_name') ?? $request->input('name') ?? ''));
        $last = trim((string) ($request->input('last_name') ?? $request->input('lastname') ?? ''));
        $email = strtolower(trim((string) $request->input('email', '')));
        $password = (string) $request->input('password', '');

        if ($email === '' || ! str_contains($email, '@')) {
            return response()->json(['error' => 'validation', 'message' => 'Valid email required'], 400);
        }
        if (strlen($password) < 6) {
            return response()->json(['error' => 'validation', 'message' => 'Password min 6 characters'], 400);
        }
        if (User::query()->whereRaw('lower(email) = ?', [$email])->exists()) {
            return response()->json(['error' => 'conflict', 'message' => 'Email already registered'], 409);
        }

        $user = User::query()->create([
            'first_name' => $first,
            'last_name' => $last,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user' => $user->toPublicArray(),
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $email = strtolower(trim((string) $request->input('email', '')));
        $password = (string) $request->input('password', '');

        if ($email === '' || $password === '') {
            return response()->json(['error' => 'validation', 'message' => 'Email and password required'], 400);
        }

        $user = User::query()->whereRaw('lower(email) = ?', [$email])->first();
        if (! $user || ! $user->password || ! Hash::check($password, $user->password)) {
            return response()->json(['error' => 'unauthorized', 'message' => 'Invalid email or password'], 401);
        }

        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user' => $user->toPublicArray(),
        ]);
    }

    public function me(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        return response()->json(['user' => $user->toPublicArray()]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()?->currentAccessToken()?->delete();

        return response()->json(['ok' => true]);
    }

    public function changePassword(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();
        $current = (string) $request->input('current_password', '');
        $next = (string) $request->input('new_password', '');

        if (strlen($next) < 6) {
            return response()->json(['error' => 'validation', 'message' => 'New password min 6 characters'], 400);
        }
        if (! $user->password || ! Hash::check($current, $user->password)) {
            return response()->json(['error' => 'unauthorized', 'message' => 'Current password is incorrect'], 401);
        }

        $user->password = Hash::make($next);
        $user->save();

        return response()->json(['ok' => true]);
    }

    public function forgotPassword(Request $request): JsonResponse
    {
        $email = strtolower(trim((string) $request->input('email', '')));
        if ($email === '') {
            return response()->json(['error' => 'validation', 'message' => 'Email required'], 400);
        }

        $payload = [
            'ok' => true,
            'message' => 'If that email exists, a reset code was created.',
        ];

        $user = User::query()->whereRaw('lower(email) = ?', [$email])->first();
        if (! $user) {
            return response()->json($payload);
        }

        $token = bin2hex(random_bytes(3));
        PasswordResetToken::query()->create([
            'user_id' => $user->id,
            'token' => $token,
            'expires_at' => now()->addHour(),
            'created_at' => now(),
        ]);

        // No mailer yet — return token for in-dev reset (same as former Node API).
        return response()->json(array_merge($payload, [
            'reset_token' => $token,
            'email' => $email,
        ]));
    }

    public function resetPassword(Request $request): JsonResponse
    {
        $email = strtolower(trim((string) $request->input('email', '')));
        $token = strtolower(trim((string) $request->input('token', '')));
        $newPass = (string) $request->input('new_password', '');

        if ($email === '' || $token === '' || strlen($newPass) < 6) {
            return response()->json([
                'error' => 'validation',
                'message' => 'email, token, and new_password (min 6) required',
            ], 400);
        }

        $user = User::query()->whereRaw('lower(email) = ?', [$email])->first();
        if (! $user) {
            return response()->json(['error' => 'validation', 'message' => 'Invalid reset code'], 400);
        }

        $row = PasswordResetToken::query()
            ->where('user_id', $user->id)
            ->whereRaw('lower(token) = ?', [$token])
            ->whereNull('used_at')
            ->where('expires_at', '>', now())
            ->orderByDesc('created_at')
            ->first();

        if (! $row) {
            return response()->json(['error' => 'validation', 'message' => 'Invalid or expired reset code'], 400);
        }

        $user->password = Hash::make($newPass);
        $user->save();
        $row->used_at = now();
        $row->save();

        return response()->json(['ok' => true]);
    }
}
