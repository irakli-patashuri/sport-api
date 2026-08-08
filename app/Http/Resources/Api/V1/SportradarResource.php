<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Wraps a MatchLink (+ its loaded sportradarMatch/tournament/timeline) to
 * expose Sportradar-sourced enrichment for a `matches` row. Only ever
 * constructed when a link exists — MatchResource returns {'linked': false}
 * directly when there is none, rather than instantiating this with nulls.
 */
class SportradarResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $match = $this->sportradarMatch;

        return [
            'linked' => true,
            'confidence' => round((float) $this->confidence, 3),
            'sportradar_match_id' => $this->sportradar_match_id,
            'status' => $match?->status_name,
            'match_time' => $match?->match_time,
            'period' => $match?->period,
            'score' => [
                'home' => $match?->home_score,
                'away' => $match?->away_score,
            ],
            'tournament' => $match?->relationLoaded('tournament') && $match->tournament
                ? [
                    'id' => $match->tournament->id,
                    'name' => $match->tournament->name,
                    'category' => $match->tournament->category_name,
                ]
                : null,
            'timeline' => $match?->relationLoaded('timeline')
                ? SportradarTimelineResource::collection($match->timeline)
                : [],
        ];
    }
}
