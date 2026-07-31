<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class MatchEventResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'type_id' => $this->type_id,
            'side' => $this->side,
            'minute' => $this->minute,
            'period' => $this->period_sequence,
            'value' => $this->event_value,
            'event_ts' => $this->event_ts,
            'event_at' => optional($this->event_at)?->toIso8601String(),
        ];
    }
}
