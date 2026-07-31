<?php

namespace App\Console\Commands;

use App\Services\MatchBroadcastService;
use Illuminate\Console\Command;

class BroadcastMatchCommand extends Command
{
    protected $signature = 'sport:broadcast-match {id : Match ID from sport_api.matches}';

    protected $description = 'Broadcast a match.updated event over WebSockets (sample / manual trigger)';

    public function handle(MatchBroadcastService $broadcastService): int
    {
        $id = (int) $this->argument('id');

        if (! $broadcastService->broadcastMatchUpdated($id)) {
            $this->error("Match {$id} not found.");

            return self::FAILURE;
        }

        $this->info("Broadcasted match.updated for #{$id}");

        return self::SUCCESS;
    }
}
