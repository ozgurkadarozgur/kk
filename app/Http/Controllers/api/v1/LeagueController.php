<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\League\ApplyForLeagueRequest;
use App\Http\Resources\League\LeagueCollection;
use App\Http\Resources\League\LeagueResource;
use App\Repositories\Interfaces\ILeagueApplicationRepository;
use App\Repositories\Interfaces\ILeagueRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LeagueController extends Controller
{
    private $leagueRepository;
    private $leagueApplicationRepository;

    public function __construct(ILeagueRepository $leagueRepository, ILeagueApplicationRepository $leagueApplicationRepository)
    {
        $this->leagueRepository = $leagueRepository;
        $this->leagueApplicationRepository = $leagueApplicationRepository;
    }

    public function index()
    {
        $leagues = $this->leagueRepository->paginate(50);
        if ($leagues) {
            return response()->json([
                'data' => new LeagueCollection($leagues),
                'status' => 'success',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        $league = $this->leagueRepository->findById($id);
        if ($league) {
            return response()->json([
                'data' => new LeagueResource($league),
                'status' => 'success',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function apply(ApplyForLeagueRequest $request, $id)
    {
        $validated = $request->validated();
        $user = $request->user();
        $validated['player_id'] = $user->id;
        $application = $this->leagueApplicationRepository->apply($id, $validated);
        if ($application) {
            return response()->json([
                'status' => 'success',
            ], Response::HTTP_CREATED);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
