<?php

namespace App\Http\Requests\Api\V1\Match;

use Illuminate\Foundation\Http\FormRequest;

class IndexMatchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'sport_id' => ['nullable', 'integer', 'min:1'],
            'country_id' => ['nullable', 'integer', 'min:1'],
            'league_id' => ['nullable', 'integer', 'min:1'],
            'is_live' => ['nullable', 'boolean'],
            'search' => ['nullable', 'string', 'max:100'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }

    /**
     * @return array{
     *   sport_id: ?int,
     *   country_id: ?int,
     *   league_id: ?int,
     *   is_live: ?bool,
     *   search: ?string,
     *   per_page: ?int
     * }
     */
    public function filters(): array
    {
        $validated = $this->validated();

        return [
            'sport_id' => $validated['sport_id'] ?? null,
            'country_id' => $validated['country_id'] ?? null,
            'league_id' => $validated['league_id'] ?? null,
            'is_live' => array_key_exists('is_live', $validated)
                ? filter_var($validated['is_live'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)
                : null,
            'search' => $validated['search'] ?? null,
            'per_page' => $validated['per_page'] ?? null,
        ];
    }
}
