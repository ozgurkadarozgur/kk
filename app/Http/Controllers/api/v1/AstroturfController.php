<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\CollectionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Astroturf\FilterAndSortAstroturfRequest;
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

    public function filter_n_sort(FilterAndSortAstroturfRequest $request)
    {
        $validated = $request->validated();
        $result = null;
        if (isset($validated['filter'])) {
            $filter = $validated['filter'];
            if (isset($filter['city_id']) or isset($filter['district_id'])){
                if (isset($filter['district_id'])){
                    $district_id = $filter['district_id'];
                    $result = $this->astroturfRepository->findByDistrictId($district_id);
                }
                if (isset($filter['city_id'])){
                    $city_id = $filter['city_id'];
                    $result = $this->astroturfRepository->findByCityId($city_id);
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'city_id property or district_id property is required in filter object',
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        } else {
            $result = $this->astroturfRepository->all();
        }

        if (isset($validated['sort'])) {
            $sort = $validated['sort'];
            if (isset($sort['type']) and isset($sort['direction'])) {
                $type = $sort['type'];
                $direction = $sort['direction'];
                $result = $result->sortBy($type, SORT_REGULAR, ($direction == "desc"));
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'type and direction properties are required in sort object',
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }

        if ($result) {
            $result = CollectionHelper::paginate($result, 50);
            return response()->json([
                'data' => new AstroturfCollection($result),
                'status' => 'success',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
