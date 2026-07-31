<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Match\IndexMatchRequest;
use App\Http\Resources\Api\V1\MatchResource;
use App\Services\MatchService;
use App\Support\ApiPaginator;
use Illuminate\Http\JsonResponse;

class MatchController extends Controller
{
    public function __construct(
        private readonly MatchService $matchService
    ) {
    }

    public function index(IndexMatchRequest $request): JsonResponse
    {
        $paginator = $this->matchService->list($request->filters());

        return $this->successResponse(
            ApiPaginator::wrap($paginator, MatchResource::collection($paginator->items())),
            'Matches retrieved successfully'
        );
    }

    public function show(int $id): JsonResponse
    {
        $match = $this->matchService->find($id);

        if ($match === null) {
            return $this->notFoundResponse('Match not found');
        }

        return $this->successResponse(
            new MatchResource($match),
            'Match retrieved successfully'
        );
    }
}
