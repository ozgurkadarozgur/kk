<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminMiddleware;
use App\Repositories\Interfaces\IAstroturfRepository;
use App\Repositories\Interfaces\IFacilityRepository;
use App\Repositories\Interfaces\IPlayerRepository;
use App\Repositories\Interfaces\ITeamRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    private $facilityRepository;
    private $playerRepository;
    private $teamRepository;
    private $astroturfRepository;

    public function __construct(IFacilityRepository $facilityRepository, IPlayerRepository $playerRepository, ITeamRepository $teamRepository, IAstroturfRepository $astroturfRepository)
    {
        $this->middleware(AdminMiddleware::class);
        $this->facilityRepository = $facilityRepository;
        $this->playerRepository = $playerRepository;
        $this->teamRepository = $teamRepository;
        $this->astroturfRepository = $astroturfRepository;
    }

    public function index()
    {
        $facilities = $this->facilityRepository->all(10);
        $players = $this->playerRepository->all(10);
        $teams = $this->teamRepository->all(10);

        $info = [
            'astroturf_count' => $this->astroturfRepository->all()->count(),
            'player_count' => $this->playerRepository->all()->count(),
            'team_count' => $this->teamRepository->all()->count(),
        ];

        return view('admin.home', compact('facilities', 'players', 'teams', 'info'));
    }

}
