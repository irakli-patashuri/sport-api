<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\UserFavorite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FavoriteController extends Controller
{
    private const KINDS = ['match', 'league', 'team', 'post'];

    public function index(Request $request): JsonResponse
    {
        $kind = $request->query('kind');
        if ($kind !== null && ! in_array($kind, self::KINDS, true)) {
            return response()->json(['error' => 'validation', 'message' => 'Invalid kind'], 400);
        }

        $q = UserFavorite::query()
            ->where('user_id', $request->user()->id)
            ->orderByDesc('created_at');

        if ($kind) {
            $q->where('kind', $kind);
        }

        return response()->json([
            'data' => $q->get()->map(fn (UserFavorite $f) => $f->toApiArray())->values(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $kind = (string) $request->input('kind', '');
        $targetId = trim((string) $request->input('target_id', ''));
        $meta = is_array($request->input('meta')) ? $request->input('meta') : [];

        if (! in_array($kind, self::KINDS, true) || $targetId === '') {
            return response()->json(['error' => 'validation', 'message' => 'kind and target_id required'], 400);
        }

        $fav = UserFavorite::query()->updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'kind' => $kind,
                'target_id' => $targetId,
            ],
            [
                'meta' => $meta,
                'created_at' => now(),
            ]
        );

        return response()->json(['data' => $fav->toApiArray()], 201);
    }

    public function destroy(Request $request, string $kind, string $targetId): Response|JsonResponse
    {
        if (! in_array($kind, self::KINDS, true)) {
            return response()->json(['error' => 'validation', 'message' => 'Invalid kind'], 400);
        }

        UserFavorite::query()
            ->where('user_id', $request->user()->id)
            ->where('kind', $kind)
            ->where('target_id', urldecode($targetId))
            ->delete();

        return response()->noContent();
    }
}
