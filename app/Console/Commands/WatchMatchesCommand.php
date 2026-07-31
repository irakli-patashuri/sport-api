<?php

namespace App\Console\Commands;

use App\Models\SportMatch;
use App\Services\MatchBroadcastService;
use Carbon\Carbon;
use Illuminate\Console\Command;

/**
 * Polls PostgreSQL for recently updated matches and broadcasts them.
 * Bridges sport-node-api DB writes → Laravel WebSocket clients.
 */
class WatchMatchesCommand extends Command
{
    protected $signature = 'sport:watch-matches
                            {--interval=2 : Poll interval in seconds}
                            {--live-only : Only watch is_live=true matches}';

    protected $description = 'Watch matches.updated_at and broadcast MatchUpdated events';

    public function handle(MatchBroadcastService $broadcastService): int
    {
        $interval = max(1, (int) $this->option('interval'));
        $liveOnly = (bool) $this->option('live-only');
        $since = Carbon::now()->subSeconds($interval);

        $this->info("Watching matches (interval={$interval}s".($liveOnly ? ', live-only' : '').')… Ctrl+C to stop.');

        while (true) {
            $query = SportMatch::query()
                ->where('updated_at', '>', $since)
                ->orderBy('updated_at');

            if ($liveOnly) {
                $query->where('is_live', true);
            }

            $ids = $query->pluck('id');
            $since = Carbon::now();

            foreach ($ids as $id) {
                if ($broadcastService->broadcastMatchUpdated((int) $id)) {
                    $this->line('['.now()->toTimeString()."] broadcasted match #{$id}");
                }
            }

            sleep($interval);
        }
    }
}
