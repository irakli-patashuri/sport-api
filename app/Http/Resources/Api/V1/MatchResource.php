<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class MatchResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'sport_id' => $this->sport_id,
            'country_id' => $this->country_id,
            'league_id' => $this->league_id,
            'home_team' => [
                'id' => $this->home_team_id,
                'name' => $this->home_team_name,
            ],
            'away_team' => [
                'id' => $this->away_team_id,
                'name' => $this->away_team_name,
            ],
            'is_live' => (bool) $this->is_live,
            'is_blocked' => (bool) $this->is_blocked,
            'game_state' => $this->game_state,
            'game_time' => $this->game_time,
            'add_minutes' => $this->add_minutes,
            'add_info' => $this->add_info,
            'markets_count' => $this->markets_count,
            'starts_at' => optional($this->starts_at)?->toIso8601String(),
            'score' => $this->whenLoaded('score', fn () => new ScoreResource($this->score)),
            'sport' => $this->whenLoaded('sport', fn () => new SportResource($this->sport)),
            'country' => $this->whenLoaded('country', fn () => new CountryResource($this->country)),
            'league' => $this->whenLoaded('league', fn () => [
                'id' => $this->league->id,
                'name' => $this->league->name,
            ]),
            'statistics' => $this->whenLoaded(
                'statistics',
                fn () => StatisticResource::collection($this->statistics)
            ),
            'events' => $this->whenLoaded(
                'events',
                fn () => MatchEventResource::collection($this->events)
            ),
            'updated_at' => optional($this->updated_at)?->toIso8601String(),
        ];
    }
}
