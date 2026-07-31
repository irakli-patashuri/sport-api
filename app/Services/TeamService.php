<?php

namespace App\Services;

use App\Models\Team;
use App\Support\ApiPaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TeamService
{
    /**
     * @param  array{search?: string|null, per_page?: int|null}  $filters
     */
    public function list(array $filters = []): LengthAwarePaginator
    {
        $query = Team::query()->orderBy('name');

        if (! empty($filters['search'])) {
            $search = trim((string) $filters['search']);
            $query->where('name', 'ilike', "%{$search}%");
        }

        return $query->paginate(ApiPaginator::perPage($filters['per_page'] ?? null));
    }

    public function find(int $id): ?Team
    {
        return Team::query()->find($id);
    }
}
