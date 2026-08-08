<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class SportradarTimelineResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'type' => $this->event_type,
            'match_time' => $this->match_time,
            'period' => $this->period,
            'team' => $this->team,
            'player' => $this->player_name,
            'description' => $this->description,
            'seq' => $this->event_seq,
        ];
    }
}
