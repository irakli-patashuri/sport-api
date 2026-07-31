<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Sport\IndexSportRequest;
use App\Http\Resources\Api\V1\SportResource;
use App\Services\SportService;
use App\Support\ApiPaginator;
use Illuminate\Http\JsonResponse;

class SportController extends Controller
{
    public function __construct(
        private readonly SportService $sportService
    ) {
    }

    public function index(IndexSportRequest $request): JsonResponse
    {
        $paginator = $this->sportService->list($request->filters());

        return $this->successResponse(
            ApiPaginator::wrap($paginator, SportResource::collection($paginator->items())),
            'Sports retrieved successfully'
        );
    }

    public function show(int $id): JsonResponse
    {
        $sport = $this->sportService->find($id);

        if ($sport === null) {
            return $this->notFoundResponse('Sport not found');
        }

        return $this->successResponse(
            new SportResource($sport),
            'Sport retrieved successfully'
        );
    }
}
