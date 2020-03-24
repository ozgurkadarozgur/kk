<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TeamMember\StoreTeamMemberRequest;
use App\Http\Resources\TeamMember\TeamMemberResource;
use App\Repositories\Interfaces\ITeamMemberRepository;
use App\Repositories\Interfaces\ITeamRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamMemberController extends Controller
{
    private $teamRepository;
    private $teamMemberRepository;

    public function __construct(ITeamMemberRepository $teamMemberRepository, ITeamRepository $teamRepository)
    {
        $this->teamMemberRepository = $teamMemberRepository;
        $this->teamRepository = $teamRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($team_id)
    {
        $team = $this->teamRepository->findById($team_id);
        if ($team) {
            return response()->json([
                'data' => TeamMemberResource::collection($team->members),
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
    public function store(StoreTeamMemberRequest $request, $id)
    {
        $validated = $request->validated();
        $validated['team_id'] = $id;
        $member = $this->teamMemberRepository->create($validated);
        if ($member) {
            return response()->json([
                'data' => new TeamMemberResource($member),
                'status' => 'success',
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
        //
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
        $member = $this->teamMemberRepository->destroy($id);
        return response()->json([
            'status' => 'success',
            'data' => new TeamMemberResource($member),
        ]);

    }
}
