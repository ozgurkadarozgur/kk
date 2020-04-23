<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\CloudinaryHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Team\SetTeamImageRequest;
use App\Http\Requests\Api\Team\SetTeamLineupRequest;
use App\Http\Requests\Api\Team\SetTeamTopPlayersRequest;
use App\Http\Requests\Api\Team\StoreTeamRequest;
use App\Http\Resources\Team\TeamCollection;
use App\Http\Resources\Team\TeamResource;
use App\Repositories\Interfaces\ITeamRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends Controller
{

    private $teamRepository;

    public function __construct(ITeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $player = \request()->user();
        $teams = $this->teamRepository->findTeamsForVs($player);
        if ($teams) {
            return response()->json([
                'data' => new TeamCollection($teams),
                'status' => 'success',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeamRequest $request)
    {
        $validated = $request->validated();
        $user = $request->user();
        $validated['owner_id'] = $user->id;
        $team = $this->teamRepository->create($validated);
        if ($team) {
            if (isset($validated['image'])) {
                $upload_result = CloudinaryHelper::upload_image($validated['image'], 'assets');
                if ($upload_result) {
                    $team->image_url = $upload_result['url'];
                    $team->save();
                }
            }
            return response()->json([
                'status' => 'success',
                'data' => new TeamResource($team),
            ], Response::HTTP_CREATED);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = $this->teamRepository->findById($id);
        if ($team) {
            return response()->json([
                'data' => new TeamResource($team),
                'status' => 'success',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = $this->teamRepository->destroy($id);
        if ($team) {
            return response()->json([
                'status' => 'success',
                'data' => new TeamResource($team),
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function set_image(SetTeamImageRequest $request, $id)
    {
        $validated = $request->validated();
        $team = $this->teamRepository->findById($id);
        $upload_result = CloudinaryHelper::upload_image($validated['image'], 'assets');
        if ($upload_result) {
            $team->image_url = $upload_result['url'];
            $team->save();
            return response()->json([
                'status' => 'success',
                'data' => new TeamResource($team),
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function set_lineup(SetTeamLineupRequest $request, $id)
    {
        $validated = $request->validated();
        $team = $this->teamRepository->setLineup($id, $validated['lineup']);
        if ($team) {
            return response()->json([
                'data' => new TeamResource($team),
                'status' => 'success',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function set_top_players(SetTeamTopPlayersRequest $request, $id)
    {
        $validated = $request->validated();
        $team = $this->teamRepository->setTopPlayers($id, $validated['top_players']);
        if ($team) {
            return response()->json([
                'data' => new TeamResource($team),
                'status' => 'success',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
