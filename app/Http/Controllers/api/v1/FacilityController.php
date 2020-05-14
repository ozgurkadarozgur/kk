<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Facility\FacilityResource;
use App\Repositories\Interfaces\IFacilityRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FacilityController extends Controller
{
    private $facilityRepository;

    public function __construct(IFacilityRepository $facilityRepository)
    {
        $this->facilityRepository = $facilityRepository;
    }

    public function show($id)
    {
        $facility = $this->facilityRepository->findById($id);
        if ($facility) {
            return response()->json([
                'data' => new FacilityResource($facility),
                'status' => 'success',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
