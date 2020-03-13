<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\IAstroturfRepository;
use App\Repositories\Interfaces\IFacilityRepository;
use App\Repositories\Interfaces\IPlayerRepository;
use App\Repositories\Interfaces\ITeamRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $facilityRepository;
    private $playerRepository;
    private $teamRepository;
    private $astroturfRepository;

    public function __construct(IFacilityRepository $facilityRepository, IPlayerRepository $playerRepository, ITeamRepository $teamRepository, IAstroturfRepository $astroturfRepository)
    {
        $this->facilityRepository = $facilityRepository;
        $this->playerRepository = $playerRepository;
        $this->teamRepository = $teamRepository;
        $this->astroturfRepository = $astroturfRepository;
    }

    public function index()
    {
        //return view('admin.astroturf.reservation');
        $facilities = $this->facilityRepository->all();
        $players = $this->playerRepository->all();
        $teams = $this->teamRepository->all();

        $info = [
            'astroturf_count' => $this->astroturfRepository->all()->count(),
            'player_count' => $this->playerRepository->all()->count(),
            'team_count' => $this->teamRepository->all()->count(),
        ];

        return view('admin.home', compact('facilities', 'players', 'teams', 'info'));
    }

}
