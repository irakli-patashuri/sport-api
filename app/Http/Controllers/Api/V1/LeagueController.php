<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\League\IndexLeagueRequest;
use App\Http\Resources\Api\V1\LeagueResource;
use App\Services\LeagueService;
use App\Support\ApiPaginator;
use Illuminate\Http\JsonResponse;

class LeagueController extends Controller
{
    public function __construct(
        private readonly LeagueService $leagueService
    ) {
    }

    public function index(IndexLeagueRequest $request): JsonResponse
    {
        $paginator = $this->leagueService->list($request->filters());

        return $this->successResponse(
            ApiPaginator::wrap($paginator, LeagueResource::collection($paginator->items())),
            'Leagues retrieved successfully'
        );
    }

    public function show(int $id): JsonResponse
    {
        $league = $this->leagueService->find($id);

        if ($league === null) {
            return $this->notFoundResponse('League not found');
        }

        return $this->successResponse(
            new LeagueResource($league),
            'League retrieved successfully'
        );
    }
}
