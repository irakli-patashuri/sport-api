<?php

namespace App\Support;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class ApiPaginator
{
    /**
     * @return array{items: mixed, meta: array<string, int>}
     */
    public static function wrap(LengthAwarePaginator $paginator, mixed $items): array
    {
        return [
            'items' => $items,
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'last_page' => $paginator->lastPage(),
            ],
        ];
    }

    public static function perPage(?int $perPage, int $default = 50, int $max = 100): int
    {
        $value = $perPage ?? $default;

        return max(1, min((int) $value, $max));
    }
}
