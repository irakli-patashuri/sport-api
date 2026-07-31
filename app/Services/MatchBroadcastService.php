<?php

namespace App\Services;

use App\Events\MatchUpdated;
use App\Models\SportMatch;
use Illuminate\Support\Facades\Log;

/**
 * Publishes match changes to WebSocket clients after DB reads/writes.
 */
class MatchBroadcastService
{
    public function __construct(
        private readonly MatchService $matchService
    ) {
    }

    /**
     * Load fresh match from DB and broadcast to sockets.
     * Call this right after persisting / detecting a match update.
     */
    public function broadcastMatchUpdated(int $matchId): bool
    {
        $match = $this->matchService->find($matchId);

        if ($match === null) {
            Log::warning('MatchBroadcastService: match not found', ['match_id' => $matchId]);

            return false;
        }

        return $this->broadcast($match);
    }

    /**
     * Broadcast an already-loaded match model (must include relations you want in payload).
     */
    public function broadcast(SportMatch $match): bool
    {
        if (! $match->relationLoaded('score')) {
            $match->load([
                'score',
                'sport:id,name,alias',
                'country:id,name,alias',
                'league:id,name',
            ]);
        }

        event(new MatchUpdated($match));

        Log::debug('MatchBroadcastService: broadcasted', [
            'match_id' => $match->id,
            'sport_id' => $match->sport_id,
        ]);

        return true;
    }
}
