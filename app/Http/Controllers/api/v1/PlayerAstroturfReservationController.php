<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\PayfullHelper;
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
        $card = $validated['card'];

        $meta = [
            'player_id' => $user->id,
            'astroturf_id' => $id,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ];
        try {
            $response = PayfullHelper::request($user, $card, '0.01',$meta);
            return response()->json($response);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }

        /*
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
         */
    }
}
