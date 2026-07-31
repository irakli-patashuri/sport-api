<?php

namespace App\Services;

use App\Models\League;
use App\Support\ApiPaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class LeagueService
{
    /**
     * @param  array{
     *   search?: string|null,
     *   sport_id?: int|null,
     *   country_id?: int|null,
     *   per_page?: int|null
     * }  $filters
     */
    public function list(array $filters = []): LengthAwarePaginator
    {
        $query = League::query()
            ->with(['country:id,name,alias'])
            ->withCount(['matches as live_matches_count' => fn ($q) => $q->where('is_live', true)])
            ->orderBy('name');

        if (! empty($filters['sport_id'])) {
            $query->where('sport_id', (int) $filters['sport_id']);
        }

        if (! empty($filters['country_id'])) {
            $query->where('country_id', (int) $filters['country_id']);
        }

        if (! empty($filters['search'])) {
            $search = trim((string) $filters['search']);
            $query->where('name', 'ilike', "%{$search}%");
        }

        return $query->paginate(ApiPaginator::perPage($filters['per_page'] ?? null));
    }

    public function find(int $id): ?League
    {
        return League::query()
            ->with(['country:id,name,alias'])
            ->withCount(['matches as live_matches_count' => fn ($q) => $q->where('is_live', true)])
            ->find($id);
    }
}
