<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\IPlayerPositionRepository;
use Illuminate\Http\Request;

class PlayerPositionController extends Controller
{
    private $playerPositionRepository;

    public function __construct(IPlayerPositionRepository $playerPositionRepository)
    {
        $this->playerPositionRepository = $playerPositionRepository;
    }

    public function index()
    {
        $positions = $this->playerPositionRepository->all();
        return response()->json([
            'status' => 'success',
            'data' => $positions,
        ]);
    }

}
