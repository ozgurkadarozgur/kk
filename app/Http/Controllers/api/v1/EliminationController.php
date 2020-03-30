<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\CollectionHelper;
use App\Helpers\PayfullHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Elimination\ApplyForEliminationRequest;
use App\Http\Requests\Api\Elimination\FilterAndSortEliminationRequest;
use App\Http\Resources\Elimination\EliminationCollection;
use App\Http\Resources\Elimination\EliminationResource;
use App\Repositories\Interfaces\IEliminationApplicationRepository;
use App\Repositories\Interfaces\IEliminationRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use function PHPSTORM_META\type;
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
        $card = $validated['card'];

        $meta = [
            'player_id' => $user->id,
            'elimination_id' => $id,
            'team_id' => $validated['team_id'],
            'process_type' => PayfullHelper::PROCESS_TYPE_ELIMINATION_APPLICATION,
        ];
        $meta = json_encode($meta);
        try {
            $response = PayfullHelper::request($user, $card, '0.01', $meta);
            return response()->json($response);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 'error',
                'file' => $ex->getFile(),
                'line' => $ex->getLine(),
                'message' => $ex->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        /*
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
        */
    }

    public function filter_n_sort(FilterAndSortEliminationRequest $request)
    {
        $validated = $request->validated();
        $result = null;
        if (isset($validated['filter'])) {
            $filter = $validated['filter'];
            if (isset($filter['district_id'])){
                $district_id = $filter['district_id'];
                $result = $this->eliminationRepository->findByDistrictId($district_id);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'district_id property is required in filter object',
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        } else {
            $result = $this->eliminationRepository->all();
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
                'data' => new EliminationCollection($result),
                'status' => 'success',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
