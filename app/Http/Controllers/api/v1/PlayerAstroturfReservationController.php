<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PlayerAstroturfReservation\StorePlayerAstroturfReservationRequest;
use App\Repositories\Interfaces\IPlayerAstroturfReservationRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlayerAstroturfReservationController extends Controller
{

    private $playerAstroturfReservationRepository;

    public function __construct(IPlayerAstroturfReservationRepository $playerAstroturfReservationRepository)
    {
        $this->playerAstroturfReservationRepository = $playerAstroturfReservationRepository;
    }

    public function store(StorePlayerAstroturfReservationRequest $request)
    {
        $validated = $request->validated();
        $reservation = $this->playerAstroturfReservationRepository->create($validated);
        if ($reservation) {
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
