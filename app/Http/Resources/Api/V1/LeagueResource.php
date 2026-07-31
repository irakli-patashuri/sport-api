<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class LeagueResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sport_id' => $this->sport_id,
            'country_id' => $this->country_id,
            'sort_order' => $this->sort_order,
            'live_matches_count' => (int) ($this->live_matches_count ?? 0),
            'country' => $this->whenLoaded('country', fn () => new CountryResource($this->country)),
            'updated_at' => optional($this->updated_at)?->toIso8601String(),
        ];
    }
}
