<?php

namespace App\Events;

use App\Http\Resources\Api\V1\MatchResource;
use App\Models\SportMatch;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Fired when a live match row (or nested score/stats) changes.
 * Consumed by web + mobile clients over WebSockets.
 */
class MatchUpdated implements ShouldBroadcastNow
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(
        public readonly SportMatch $match
    ) {
    }

    /**
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('matches'),
            new Channel('matches.'.$this->match->id),
            new Channel('sports.'.$this->match->sport_id.'.matches'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'match.updated';
    }

    /**
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'match' => (new MatchResource($this->match))->resolve(),
        ];
    }
}
