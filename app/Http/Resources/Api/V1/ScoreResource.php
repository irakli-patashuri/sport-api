<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ScoreResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'home' => $this->home_score,
            'away' => $this->away_score,
            'ht_home' => $this->ht_home,
            'ht_away' => $this->ht_away,
            'set2_home' => $this->set2_home,
            'set2_away' => $this->set2_away,
            'stoppage_first' => $this->stoppage_first,
            'stoppage_second' => $this->stoppage_second,
            'updated_at' => optional($this->updated_at)?->toIso8601String(),
        ];
    }
}
