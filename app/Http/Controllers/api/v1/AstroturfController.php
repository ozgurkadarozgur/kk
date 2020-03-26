<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Astroturf\AllReservationsResource;
use App\Http\Resources\Astroturf\AstroturfCollection;
use App\Http\Resources\Astroturf\AstroturfResource;
use App\Repositories\Interfaces\IAstroturfRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AstroturfController extends Controller
{

    private $astroturfRepository;

    public function __construct(IAstroturfRepository $astroturfRepository)
    {
        $this->astroturfRepository = $astroturfRepository;
    }

    public function index()
    {
        $astroturfs = $this->astroturfRepository->paginate(50);
        if ($astroturfs) {
            return response()->json([
                'data' => new AstroturfCollection($astroturfs),
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
        $astroturf = $this->astroturfRepository->findById($id);
        if ($astroturf) {
            return response()->json([
                'data' => new AstroturfResource($astroturf),
                'status' => 'success',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function reservations($id, $date)
    {
        $astroturf = $this->astroturfRepository->findById($id);
        $all_reservations = collect($astroturf->all_reservations($date));
        return response()->json([
           'status' => 'success',
           'data' => AllReservationsResource::collection($all_reservations)
        ]);
    }

}
