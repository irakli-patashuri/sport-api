<?php

namespace App\Services;

use App\Models\Country;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CountryService
{
    /**
     * @param  array{search?: string|null, per_page?: int|null}  $filters
     */
    public function list(array $filters = []): LengthAwarePaginator
    {
        $perPage = (int) ($filters['per_page'] ?? 50);
        $perPage = max(1, min($perPage, 100));

        $query = Country::query()->orderBy('name');

        if (! empty($filters['search'])) {
            $search = trim((string) $filters['search']);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'ilike', "%{$search}%")
                    ->orWhere('alias', 'ilike', "%{$search}%");
            });
        }

        return $query->paginate($perPage);
    }

    public function find(int $id): ?Country
    {
        return Country::query()->find($id);
    }

    public function all(): Collection
    {
        return Country::query()->orderBy('name')->get();
    }
}
