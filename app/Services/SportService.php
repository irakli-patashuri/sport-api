<?php

namespace App\Services;

use App\Models\Sport;
use App\Support\ApiPaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SportService
{
    /**
     * @param  array{search?: string|null, per_page?: int|null}  $filters
     */
    public function list(array $filters = []): LengthAwarePaginator
    {
        $query = Sport::query()
            ->withCount(['matches as live_matches_count' => fn ($q) => $q->where('is_live', true)])
            ->orderByDesc('live_matches_count')
            ->orderBy('name');

        if (! empty($filters['search'])) {
            $search = trim((string) $filters['search']);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'ilike', "%{$search}%")
                    ->orWhere('alias', 'ilike', "%{$search}%");
            });
        }

        return $query->paginate(ApiPaginator::perPage($filters['per_page'] ?? null));
    }

    public function find(int $id): ?Sport
    {
        return Sport::query()
            ->withCount(['matches as live_matches_count' => fn ($q) => $q->where('is_live', true)])
            ->find($id);
    }
}
