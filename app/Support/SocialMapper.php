<?php

namespace App\Support;

use App\Models\SocialComment;
use App\Models\SocialPost;
use App\Models\User;

/**
 * Maps social models to the NETSPOR client JSON shape (formerly Node /api/social).
 */
class SocialMapper
{
    public static function post(SocialPost $post, bool $liked = false, bool $bookmarked = false): array
    {
        /** @var User|null $author */
        $author = $post->relationLoaded('user') ? $post->user : $post->user()->first();
        $base = [
            'id' => (string) $post->id,
            'kind' => $post->kind === 'text' ? 'text' : $post->kind,
            'author' => [
                'id' => (string) $post->user_id,
                'name' => $author?->displayName() ?? 'User',
                'avatar' => null,
            ],
            'createdAtISO' => optional($post->created_at)?->toISOString() ?? now()->toISOString(),
            'text' => $post->body ?? '',
            'images' => $post->images ?? [],
            'likes' => (int) $post->likes_count,
            'comments' => (int) $post->comments_count,
            'shares' => (int) $post->shares_count,
            'liked' => $liked,
            'bookmarked' => $bookmarked,
        ];

        // FE Post type uses kind 'text' for plain posts
        if ($post->kind === 'coupon') {
            return array_merge($base, [
                'kind' => 'coupon',
                'match' => $post->match_snapshot,
                'pick' => $post->pick,
                'pickOdds' => $post->pick_odds !== null ? (float) $post->pick_odds : 0,
                'pickLabel' => $post->pick_label ?: null,
            ]);
        }

        if ($post->kind === 'analysis') {
            return array_merge($base, [
                'kind' => 'analysis',
                'match' => $post->match_snapshot,
                'stats' => $post->stats ?? [],
                'prediction' => $post->prediction ?: null,
                'confidence' => $post->confidence ?: null,
            ]);
        }

        return array_merge($base, ['kind' => 'text']);
    }

    public static function comment(SocialComment $comment, bool $liked = false): array
    {
        /** @var User|null $author */
        $author = $comment->relationLoaded('user') ? $comment->user : $comment->user()->first();

        return [
            'id' => (string) $comment->id,
            'postId' => (string) $comment->post_id,
            'author' => [
                'id' => (string) $comment->user_id,
                'name' => $author?->displayName() ?? 'User',
            ],
            'createdAtISO' => optional($comment->created_at)?->toISOString() ?? now()->toISOString(),
            'text' => $comment->body ?? '',
            'likes' => (int) $comment->likes_count,
            'liked' => $liked,
            'replyToId' => $comment->parent_id !== null ? (string) $comment->parent_id : null,
        ];
    }
}
