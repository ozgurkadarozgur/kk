<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Elimination\ApplyForEliminationRequest;
use App\Http\Resources\Elimination\EliminationCollection;
use App\Http\Resources\Elimination\EliminationResource;
use App\Repositories\Interfaces\IEliminationApplicationRepository;
use App\Repositories\Interfaces\IEliminationRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EliminationController extends Controller
{

    private $eliminationRepository;
    private $eliminationApplicationRepository;

    public function __construct(IEliminationRepository $eliminationRepository, IEliminationApplicationRepository $eliminationApplicationRepository)
    {
        $this->eliminationRepository = $eliminationRepository;
        $this->eliminationApplicationRepository = $eliminationApplicationRepository;
    }

    public function index()
    {
        $eliminations = $this->eliminationRepository->paginate(50);
        if ($eliminations) {
            return response()->json([
                'data' => new EliminationCollection($eliminations),
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
        $elimination = $this->eliminationRepository->findById($id);
        if ($elimination) {
            return response()->json([
                'data' => new EliminationResource($elimination),
                'status' => 'success',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function apply(ApplyForEliminationRequest $request, $id)
    {
        $validated = $request->validated();
        $user = $request->user();
        $validated['player_id'] = $user->id;
        $application = $this->eliminationApplicationRepository->apply($id, $validated);
        if ($application) {
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
