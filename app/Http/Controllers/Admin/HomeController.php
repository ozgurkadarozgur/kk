<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\IFacilityRepository;
use App\Repositories\Interfaces\IPlayerRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $facilityRepository;
    private $playerRepository;

    public function __construct(IFacilityRepository $facilityRepository, IPlayerRepository $playerRepository)
    {
        $this->facilityRepository = $facilityRepository;
        $this->playerRepository = $playerRepository;
    }

    public function index()
    {
        $facilities = $this->facilityRepository->all();
        $players = $this->playerRepository->all();
        return view('admin.home', compact('facilities', 'players'));
    }

}
