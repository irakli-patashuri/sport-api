<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Team\IndexTeamRequest;
use App\Http\Resources\Api\V1\TeamResource;
use App\Services\TeamService;
use App\Support\ApiPaginator;
use Illuminate\Http\JsonResponse;

class TeamController extends Controller
{
    public function __construct(
        private readonly TeamService $teamService
    ) {
    }

    public function index(IndexTeamRequest $request): JsonResponse
    {
        $paginator = $this->teamService->list($request->filters());

        return $this->successResponse(
            ApiPaginator::wrap($paginator, TeamResource::collection($paginator->items())),
            'Teams retrieved successfully'
        );
    }

    public function show(int $id): JsonResponse
    {
        $team = $this->teamService->find($id);

        if ($team === null) {
            return $this->notFoundResponse('Team not found');
        }

        return $this->successResponse(
            new TeamResource($team),
            'Team retrieved successfully'
        );
    }
}
