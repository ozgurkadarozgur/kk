<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Repositories\Interfaces\ICityRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{

    private $cityRepository;

    public function __construct(ICityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function index()
    {
        $cities = $this->cityRepository->all();
        return response()->json([
            'data' => $cities,
            'status' => 'success',
        ], Response::HTTP_OK);
    }

    public function districts($city_id)
    {
        $city = $this->cityRepository->findById($city_id);
        return response()->json([
            'data' => $city->districts,
            'status' => 'success',
        ], Response::HTTP_OK);
    }

}
