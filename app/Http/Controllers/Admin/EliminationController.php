<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Elimination\NextLevelEliminationRequest;
use App\Http\Requests\Admin\Elimination\StartEliminationRequest;
use App\Http\Requests\Admin\Elimination\StoreEliminationRequest;
use App\Http\Requests\Admin\Elimination\UpdateEliminationRequest;
use App\Repositories\Interfaces\IEliminationLevelRepository;
use App\Repositories\Interfaces\IEliminationMatchRepository;
use App\Repositories\Interfaces\IEliminationRepository;
use App\Repositories\Interfaces\IFacilityRepository;
use App\Repositories\Interfaces\ITeamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EliminationController extends Controller
{

    private $eliminationRepository;
    private $facilityRepository;
    private $eliminationMatchRepository;
    private $eliminationLevelRepository;
    private $teamRepository;

    public function __construct(IEliminationRepository $eliminationRepository, IFacilityRepository $facilityRepository, IEliminationMatchRepository $eliminationMatchRepository, IEliminationLevelRepository $eliminationLevelRepository, ITeamRepository $teamRepository)
    {
        $this->eliminationRepository = $eliminationRepository;
        $this->facilityRepository = $facilityRepository;
        $this->eliminationMatchRepository = $eliminationMatchRepository;
        $this->eliminationLevelRepository = $eliminationLevelRepository;
        $this->teamRepository = $teamRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eliminations = $this->eliminationRepository->all();
        return view('admin.elimination.index', compact('eliminations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facilities = $this->facilityRepository->all();
        return view('admin.elimination.create', compact('facilities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEliminationRequest $request)
    {
        $validated = $request->validated();
        $award_id_arr = array_keys($validated['award_key']);
        $award_title_arr = array_values($validated['award_title']);
        $awards = array_combine($award_id_arr, array_slice($award_title_arr, 0, count($award_id_arr)));
        $validated['awards'] = json_encode($awards);
        $this->eliminationRepository->create($validated);
        return redirect()->route('admin.elimination.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $elimination = $this->eliminationRepository->findById($id);
        return view('admin.elimination.show', compact('elimination'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $elimination = $this->eliminationRepository->findById($id);
        return view('admin.elimination.edit', compact('elimination'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEliminationRequest $request, $id)
    {
        $validated = $request->validated();
        $this->eliminationRepository->update($id, $validated);
        return redirect()->route('admin.elimination.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->eliminationRepository->delete($id);
        return redirect()->back();
    }

    public function start(StartEliminationRequest $request, $id)
    {
        $elimination = $this->eliminationRepository->findById($id);
        $applications = $elimination->applications->shuffle();
        $level = $elimination->levels()->orderBy('order', 'asc')->first();
        try {
            DB::beginTransaction();

            $elimination->is_started = true;
            $elimination->save();

            for ($i = 0; $i < count($applications); $i += 2){
                $application_team_1 = $applications[$i];
                $application_team_2 = $applications[$i + 1];
                $team1 = $application_team_1->team;
                $team2 = $application_team_2->team;
                $data['team1_id'] = $team1->id;
                $data['team2_id'] = $team2->id;
                $this->eliminationMatchRepository->create($id, $level->id, $data);
            }
            DB::commit();
            return redirect()->route('admin.elimination.matches', $id);
        } catch (\Exception $ex) {
            DB::rollBack();
            if (env('APP_DEBUG')) dd($ex);
            return redirect()->back();
        }
    }

    public function matches($id)
    {
        $elimination = $this->eliminationRepository->findById($id);
        return view('admin.elimination.matches', compact('elimination'));
    }

    public function next_level(NextLevelEliminationRequest $request, $id)
    {
        $validated = $request->validated();
        $elimination = $this->eliminationRepository->findById($id);
        $current_level = $this->eliminationLevelRepository->findById($validated['current_level_id']);
        $current_level_order = $current_level->order;
        $last_level_order = $elimination->levels->last()->order;
        if ($current_level_order < $last_level_order) {
            $winners = $this->eliminationMatchRepository->findWinnersByLevelId($current_level->id);
            $winners = $winners->shuffle();
            $winner_ids = $winners->pluck('winner')->toArray();
            $winner_teams = $this->teamRepository->findByIdList($winner_ids);
            $next_level = $elimination->levels->where('order', $current_level_order + 1)->first();
            try {
                DB::beginTransaction();

                $current_level->is_over = true;
                $current_level->save();

                for ($i = 0; $i < count($winner_teams); $i += 2){
                    $winner_team_1 = $winner_teams[$i];
                    $winner_team_2 = $winner_teams[$i + 1];
                    $data['team1_id'] = $winner_team_1->id;
                    $data['team2_id'] = $winner_team_2->id;
                    $this->eliminationMatchRepository->create($id, $next_level->id, $data);
                }
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
                if (env('APP_DEBUG')) dd($ex);
                return redirect()->back();
            }

            return redirect()->route('admin.elimination.matches', $id);
        } else {
            return 'over';
        }
    }

}
