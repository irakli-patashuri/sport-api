<?php

namespace App\Http\Requests\Api\V1\League;

use Illuminate\Foundation\Http\FormRequest;

class IndexLeagueRequest extends FormRequest
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
            'search' => ['nullable', 'string', 'max:100'],
            'sport_id' => ['nullable', 'integer', 'min:1'],
            'country_id' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }

    /**
     * @return array{search: ?string, sport_id: ?int, country_id: ?int, per_page: ?int}
     */
    public function filters(): array
    {
        return [
            'search' => $this->validated('search'),
            'sport_id' => $this->validated('sport_id'),
            'country_id' => $this->validated('country_id'),
            'per_page' => $this->validated('per_page'),
        ];
    }
}
