<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Country\IndexCountryRequest;
use App\Http\Resources\Api\V1\CountryResource;
use App\Services\CountryService;
use App\Support\ApiPaginator;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
    public function __construct(
        private readonly CountryService $countryService
    ) {
    }

    public function index(IndexCountryRequest $request): JsonResponse
    {
        $paginator = $this->countryService->list($request->filters());

        return $this->successResponse(
            ApiPaginator::wrap($paginator, CountryResource::collection($paginator->items())),
            'Countries retrieved successfully'
        );
    }

    public function show(int $id): JsonResponse
    {
        $country = $this->countryService->find($id);

        if ($country === null) {
            return $this->notFoundResponse('Country not found');
        }

        return $this->successResponse(
            new CountryResource($country),
            'Country retrieved successfully'
        );
    }
}
