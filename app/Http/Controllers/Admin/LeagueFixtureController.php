<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Requests\Admin\LeagueFixture\UpdatePartialLeagueFixtureRequest;
use App\Repositories\Interfaces\ILeagueFixtureRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeagueFixtureController extends Controller
{

    private $leagueFixtureRepository;

    public function __construct(ILeagueFixtureRepository $leagueFixtureRepository)
    {
        $this->middleware(AdminMiddleware::class);
        $this->leagueFixtureRepository = $leagueFixtureRepository;
    }

    public function update_partial(UpdatePartialLeagueFixtureRequest $request, $id)
    {
        $validated = $request->validated();
        if (isset($validated['start_date'])) $validated['start_date'] = Carbon::parse($validated['start_date']);
        if (isset($validated['start_time'])) $validated['start_time'] = Carbon::parse($validated['start_time'])->toTimeString();
        $this->leagueFixtureRepository->update_partial($id, $validated);
        return redirect()->back();
    }
}
