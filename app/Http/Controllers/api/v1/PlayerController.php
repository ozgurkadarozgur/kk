<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Player\StorePlayerRequest;
use App\Http\Resources\Player\PlayerCollection;
use App\Http\Resources\Player\PlayerResource;
use App\Http\Resources\Team\TeamResource;
use App\Http\Resources\VS\VSCollection;
use App\Repositories\Interfaces\IPlayerRepository;
use App\Repositories\Interfaces\IVSRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlayerController extends Controller
{

    private $playerRepository;
    private $vsRepository;

    public function __construct(IPlayerRepository $playerRepository, IVSRepository $vsRepository)
    {
        $this->playerRepository = $playerRepository;
        $this->vsRepository = $vsRepository;
    }

    public function index()
    {
        $players = $this->playerRepository->paginate(20);
        if ($players) {
            return response()->json([
                'data' => new PlayerCollection($players),
                'status' => 'success',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        $player = $this->playerRepository->findById($id);
        if ($player) {
            return response()->json([
                'data' => new PlayerResource($player),
                'status' => 'success',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function me(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'data' => new PlayerResource($user),
            'status' => 'success',
        ], Response::HTTP_OK);
    }

    public function teams(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'data' => TeamResource::collection($user->teams),
            'status' => 'success',
        ], Response::HTTP_OK);
    }

    public function incoming_vs_requests(Request $request)
    {
        $user = $request->user();
        $incoming_vs_requests = $this->vsRepository->incoming_vs_requests_paginate($user->id,50);
        return response()->json([
            'data' => new VSCollection($incoming_vs_requests),
            'status' => 'success',
        ], Response::HTTP_OK);
    }

    public function outgoing_vs_requests(Request $request)
    {
        $user = $request->user();
        $outgoing_vs_requests = $this->vsRepository->outgoing_vs_requests_paginate($user->id,50);
        return response()->json([
            'data' => new VSCollection($outgoing_vs_requests),
            'status' => 'success',
        ], Response::HTTP_OK);
    }

}
