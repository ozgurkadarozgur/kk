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

    public function store(StorePlayerAstroturfReservationRequest $request, $id)
    {
        $validated = $request->validated();
        $user = $request->user();
        $validated['player_id'] = $user->id;
        $validated['astroturf_id'] = $id;
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
