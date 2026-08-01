<?php

namespace App\Http\Controllers\Api\V1\Social;

use App\Http\Controllers\Controller;
use App\Models\SocialComment;
use App\Models\SocialCommentLike;
use App\Models\SocialPost;
use App\Models\SocialPostLike;
use App\Models\User;
use App\Models\UserFavorite;
use App\Support\SocialMapper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SocialController extends Controller
{
    public function listPosts(Request $request): JsonResponse
    {
        $limit = min((int) $request->query('limit', 50), 100);
        $posts = SocialPost::query()
            ->with('user')
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();

        return response()->json([
            'data' => $this->mapPostsWithFlags($posts, $request->user()),
        ]);
    }

    public function createPost(Request $request): JsonResponse
    {
        $kind = (string) $request->input('kind', '');
        $body = (string) ($request->input('body') ?? $request->input('text') ?? '');
        $images = is_array($request->input('images')) ? $request->input('images') : [];
        $matchId = $request->input('match_id');
        $matchSnapshot = $request->input('match_snapshot') ?? $request->input('match');
        $pick = $request->input('pick');
        $pickOdds = $request->input('pick_odds') ?? $request->input('pickOdds');
        $pickLabel = $request->input('pick_label') ?? $request->input('pickLabel');
        $stats = is_array($request->input('stats')) ? $request->input('stats') : [];
        $prediction = $request->input('prediction');
        $confidence = $request->input('confidence');

        if (! in_array($kind, ['text', 'coupon', 'analysis'], true)) {
            return response()->json(['error' => 'validation', 'message' => 'Invalid kind'], 400);
        }
        if ($kind === 'text' && trim($body) === '' && count($images) === 0) {
            return response()->json(['error' => 'validation', 'message' => 'Text or image required'], 400);
        }
        if ($kind === 'coupon' && (! $matchSnapshot || ! $pick || $pickOdds === null)) {
            return response()->json(['error' => 'validation', 'message' => 'coupon requires match, pick, pick_odds'], 400);
        }
        if ($kind === 'analysis' && ! $matchSnapshot) {
            return response()->json(['error' => 'validation', 'message' => 'analysis requires match'], 400);
        }

        $post = SocialPost::query()->create([
            'user_id' => $request->user()->id,
            'kind' => $kind,
            'body' => $body,
            'images' => $images,
            'match_id' => is_numeric($matchId) ? (int) $matchId : null,
            'match_snapshot' => $matchSnapshot,
            'pick' => $pick,
            'pick_odds' => $pickOdds,
            'pick_label' => $pickLabel,
            'stats' => $stats,
            'prediction' => $prediction,
            'confidence' => $confidence,
        ]);
        $post->setRelation('user', $request->user());

        return response()->json(['data' => SocialMapper::post($post)], 201);
    }

    public function showPost(Request $request, string $id): JsonResponse
    {
        $post = SocialPost::query()->with('user')->find($id);
        if (! $post) {
            return response()->json(['error' => 'not_found', 'message' => 'Post not found'], 404);
        }

        [$liked, $bookmarked] = $this->flagsForPost($post->id, $request->user());

        return response()->json(['data' => SocialMapper::post($post, $liked, $bookmarked)]);
    }

    public function deletePost(Request $request, string $id): Response|JsonResponse
    {
        $deleted = SocialPost::query()
            ->where('id', $id)
            ->where('user_id', $request->user()->id)
            ->delete();

        if (! $deleted) {
            return response()->json(['error' => 'not_found', 'message' => 'Post not found'], 404);
        }

        return response()->noContent();
    }

    public function togglePostLike(Request $request, string $id): JsonResponse
    {
        $post = SocialPost::query()->find($id);
        if (! $post) {
            return response()->json(['error' => 'not_found', 'message' => 'Post not found'], 404);
        }

        $userId = $request->user()->id;
        $existing = SocialPostLike::query()
            ->where('user_id', $userId)
            ->where('post_id', $post->id)
            ->exists();

        if ($existing) {
            SocialPostLike::query()->where('user_id', $userId)->where('post_id', $post->id)->delete();
            $post->likes_count = max(0, (int) $post->likes_count - 1);
            $liked = false;
        } else {
            SocialPostLike::query()->insert([
                'user_id' => $userId,
                'post_id' => $post->id,
                'created_at' => now(),
            ]);
            $post->likes_count = (int) $post->likes_count + 1;
            $liked = true;
        }
        $post->save();

        return response()->json(['liked' => $liked, 'likes' => (int) $post->likes_count]);
    }

    public function listComments(Request $request, string $id): JsonResponse
    {
        $comments = SocialComment::query()
            ->with('user')
            ->where('post_id', $id)
            ->orderBy('created_at')
            ->get();

        $likedSet = [];
        if ($request->user() && $comments->isNotEmpty()) {
            $likedSet = SocialCommentLike::query()
                ->where('user_id', $request->user()->id)
                ->whereIn('comment_id', $comments->pluck('id'))
                ->pluck('comment_id')
                ->map(fn ($cid) => (string) $cid)
                ->all();
            $likedSet = array_fill_keys($likedSet, true);
        }

        return response()->json([
            'data' => $comments->map(
                fn (SocialComment $c) => SocialMapper::comment($c, isset($likedSet[(string) $c->id]))
            )->values(),
        ]);
    }

    public function createComment(Request $request, string $id): JsonResponse
    {
        $body = trim((string) ($request->input('body') ?? $request->input('text') ?? ''));
        $parentRaw = $request->input('parent_id') ?? $request->input('replyToId');
        $parentId = ($parentRaw !== null && $parentRaw !== '') ? (int) $parentRaw : null;

        if ($body === '') {
            return response()->json(['error' => 'validation', 'message' => 'Comment body required'], 400);
        }

        $post = SocialPost::query()->find($id);
        if (! $post) {
            return response()->json(['error' => 'not_found', 'message' => 'Post not found'], 404);
        }

        if ($parentId !== null) {
            $parent = SocialComment::query()
                ->where('id', $parentId)
                ->where('post_id', $post->id)
                ->exists();
            if (! $parent) {
                return response()->json(['error' => 'validation', 'message' => 'Parent comment not found'], 400);
            }
        }

        $comment = SocialComment::query()->create([
            'post_id' => $post->id,
            'user_id' => $request->user()->id,
            'parent_id' => $parentId,
            'body' => $body,
            'created_at' => now(),
        ]);
        $comment->setRelation('user', $request->user());

        $post->comments_count = (int) $post->comments_count + 1;
        $post->save();

        return response()->json(['data' => SocialMapper::comment($comment)], 201);
    }

    public function toggleCommentLike(Request $request, string $id): JsonResponse
    {
        $comment = SocialComment::query()->find($id);
        if (! $comment) {
            return response()->json(['error' => 'not_found', 'message' => 'Comment not found'], 404);
        }

        $userId = $request->user()->id;
        $existing = SocialCommentLike::query()
            ->where('user_id', $userId)
            ->where('comment_id', $comment->id)
            ->exists();

        if ($existing) {
            SocialCommentLike::query()->where('user_id', $userId)->where('comment_id', $comment->id)->delete();
            $comment->likes_count = max(0, (int) $comment->likes_count - 1);
            $liked = false;
        } else {
            SocialCommentLike::query()->insert([
                'user_id' => $userId,
                'comment_id' => $comment->id,
                'created_at' => now(),
            ]);
            $comment->likes_count = (int) $comment->likes_count + 1;
            $liked = true;
        }
        $comment->save();

        return response()->json(['liked' => $liked, 'likes' => (int) $comment->likes_count]);
    }

    public function sharePost(string $id): JsonResponse
    {
        $post = SocialPost::query()->find($id);
        if (! $post) {
            return response()->json(['error' => 'not_found', 'message' => 'Post not found'], 404);
        }
        $post->shares_count = (int) $post->shares_count + 1;
        $post->save();

        return response()->json(['shares' => (int) $post->shares_count]);
    }

    public function showUser(string $id): JsonResponse
    {
        $user = User::query()->find($id);
        if (! $user) {
            return response()->json(['error' => 'not_found', 'message' => 'User not found'], 404);
        }

        $posts = SocialPost::query()->where('user_id', $user->id)->get(['kind']);

        return response()->json([
            'data' => [
                'id' => (string) $user->id,
                'first_name' => $user->first_name ?: '',
                'last_name' => $user->last_name ?: '',
                'email' => $user->email,
                'display_name' => $user->displayName(),
                'created_at' => $user->created_at,
                'posts_count' => $posts->count(),
                'coupons_count' => $posts->where('kind', 'coupon')->count(),
                'analyses_count' => $posts->where('kind', 'analysis')->count(),
            ],
        ]);
    }

    public function listUserPosts(Request $request, string $id): JsonResponse
    {
        $kind = $request->query('kind');
        $limit = min((int) $request->query('limit', 50), 100);

        $q = SocialPost::query()
            ->with('user')
            ->where('user_id', $id)
            ->orderByDesc('created_at')
            ->limit($limit);

        if (in_array($kind, ['text', 'coupon', 'analysis'], true)) {
            $q->where('kind', $kind);
        }

        $posts = $q->get();

        return response()->json([
            'data' => $this->mapPostsWithFlags($posts, $request->user()),
        ]);
    }

    private function mapPostsWithFlags($posts, $user): array
    {
        if ($posts->isEmpty()) {
            return [];
        }

        $likedSet = [];
        $bookmarkedSet = [];
        if ($user) {
            $ids = $posts->pluck('id');
            $likedSet = SocialPostLike::query()
                ->where('user_id', $user->id)
                ->whereIn('post_id', $ids)
                ->pluck('post_id')
                ->map(fn ($pid) => (string) $pid)
                ->all();
            $likedSet = array_fill_keys($likedSet, true);

            $bookmarkedSet = UserFavorite::query()
                ->where('user_id', $user->id)
                ->where('kind', 'post')
                ->whereIn('target_id', $ids->map(fn ($i) => (string) $i))
                ->pluck('target_id')
                ->all();
            $bookmarkedSet = array_fill_keys($bookmarkedSet, true);
        }

        return $posts->map(function (SocialPost $post) use ($likedSet, $bookmarkedSet) {
            return SocialMapper::post(
                $post,
                isset($likedSet[(string) $post->id]),
                isset($bookmarkedSet[(string) $post->id])
            );
        })->values()->all();
    }

    private function flagsForPost(int $postId, $user): array
    {
        if (! $user) {
            return [false, false];
        }
        $liked = SocialPostLike::query()
            ->where('user_id', $user->id)
            ->where('post_id', $postId)
            ->exists();
        $bookmarked = UserFavorite::query()
            ->where('user_id', $user->id)
            ->where('kind', 'post')
            ->where('target_id', (string) $postId)
            ->exists();

        return [$liked, $bookmarked];
    }
}
