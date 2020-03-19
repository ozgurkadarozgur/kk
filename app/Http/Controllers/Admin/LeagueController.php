<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LeagueHelper;
use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Requests\Admin\League\StoreLeagueRequest;
use App\Models\LeagueFixture;
use App\Repositories\Interfaces\IFacilityRepository;
use App\Repositories\Interfaces\ILeagueFixtureRepository;
use App\Repositories\Interfaces\ILeagueRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LeagueController extends Controller
{

    private $leagueRepository;
    private $facilityRepository;
    private $leagueFixtureRepository;

    public function __construct(ILeagueRepository $leagueRepository, IFacilityRepository $facilityRepository, ILeagueFixtureRepository $leagueFixtureRepository)
    {
        $this->middleware(AdminMiddleware::class);
        $this->leagueRepository = $leagueRepository;
        $this->facilityRepository = $facilityRepository;
        $this->leagueFixtureRepository = $leagueFixtureRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leagues = $this->leagueRepository->all();
        return view('admin.league.index', compact('leagues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facilities = $this->facilityRepository->all();
        return view('admin.league.create', compact('facilities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLeagueRequest $request)
    {
        $validated = $request->validated();
        $award_id_arr = array_keys($validated['award_key']);
        $award_title_arr = array_values($validated['award_title']);
        $awards = array_combine($award_id_arr, array_slice($award_title_arr, 0, count($award_id_arr)));
        $validated['awards'] = json_encode($awards);
        $this->leagueRepository->create($validated);
        return redirect()->route('admin.league.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $league = $this->leagueRepository->findById($id);
        return view('admin.league.show', compact('league'));
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
        //
    }

    public function start($id){
        $tournament = $this->leagueRepository->findById($id);
        $league_helper = new LeagueHelper($this->leagueFixtureRepository);
        $league_helper->create_fixture($tournament);
        $tournament->is_started = true;
        $tournament->save();
        return redirect()->route('admin.league.fixture', $id);
    }

    public function fixture($id)
    {
        $league = $this->leagueRepository->findById($id);
        return view('admin.league.fixture', compact('league'));
    }

}
