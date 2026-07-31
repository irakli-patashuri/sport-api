<?php

namespace App\Services;

use App\Models\SportMatch;
use App\Support\ApiPaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MatchService
{
    /**
     * @param  array{
     *   sport_id?: int|null,
     *   country_id?: int|null,
     *   league_id?: int|null,
     *   is_live?: bool|null,
     *   search?: string|null,
     *   per_page?: int|null
     * }  $filters
     */
    public function list(array $filters = []): LengthAwarePaginator
    {
        $query = SportMatch::query()
            ->with([
                'score',
                'sport:id,name,alias',
                'country:id,name,alias',
                'league:id,name,sport_id,country_id',
            ])
            ->orderByDesc('is_live')
            ->orderByDesc('updated_at');

        if (array_key_exists('is_live', $filters) && $filters['is_live'] !== null) {
            $query->where('is_live', (bool) $filters['is_live']);
        } else {
            // Default feed for mobile/web: live matches
            $query->where('is_live', true);
        }

        if (! empty($filters['sport_id'])) {
            $query->where('sport_id', (int) $filters['sport_id']);
        }

        if (! empty($filters['country_id'])) {
            $query->where('country_id', (int) $filters['country_id']);
        }

        if (! empty($filters['league_id'])) {
            $query->where('league_id', (int) $filters['league_id']);
        }

        if (! empty($filters['search'])) {
            $search = trim((string) $filters['search']);
            $query->where(function ($q) use ($search) {
                $q->where('home_team_name', 'ilike', "%{$search}%")
                    ->orWhere('away_team_name', 'ilike', "%{$search}%");
            });
        }

        return $query->paginate(ApiPaginator::perPage($filters['per_page'] ?? null, 30));
    }

    public function find(int $id): ?SportMatch
    {
        return SportMatch::query()
            ->with([
                'score',
                'statistics',
                'events' => fn ($q) => $q->orderBy('event_ts')->orderBy('id'),
                'sport:id,name,alias',
                'country:id,name,alias',
                'league:id,name,sport_id,country_id',
                'homeTeam:id,name',
                'awayTeam:id,name',
            ])
            ->find($id);
    }
}
