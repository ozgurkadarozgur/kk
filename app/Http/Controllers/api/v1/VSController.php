<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\PayfullHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\VS\InvitedApproveRequest;
use App\Http\Requests\Api\VS\InvitedRejectRequest;
use App\Http\Requests\Api\VS\InviterApproveRequest;
use App\Http\Requests\Api\VS\InviterCancelRequest;
use App\Http\Requests\Api\VS\VSRequest;
use App\Models\VSStatus;
use App\Repositories\Interfaces\IAstroturfRepository;
use App\Repositories\Interfaces\ITeamRepository;
use App\Repositories\Interfaces\IVSRepository;
use App\Repositories\Interfaces\IVSReservationRepository;
use App\Rules\VS\VSApproveCheckIsPlayerInvited;
use Symfony\Component\HttpFoundation\Response;

class VSController extends Controller
{

    private $vsRepository;
    private $vsReservationRepository;
    private $astroturfRepository;
    private $teamRepository;

    public function __construct(IVSRepository $vsRepository, IVSReservationRepository $vsReservationRepository,IAstroturfRepository $astroturfRepository, ITeamRepository $teamRepository)
    {
        $this->vsRepository = $vsRepository;
        $this->vsReservationRepository = $vsReservationRepository;
        $this->astroturfRepository = $astroturfRepository;
        $this->teamRepository = $teamRepository;
    }

    public function vs_request(VSRequest $request)
    {
        $validated = $request->validated();
        $user = $request->user();
        $invited_team = $this->teamRepository->findById($validated['invited_team_id']);
        $astroturf = $this->astroturfRepository->findById($validated['astroturf_id']);
        $validated['inviter_id'] = $user->id;
        $validated['invited_id'] = $invited_team->owner_id;
        $validated['cost'] = $astroturf->price;
        $vs = $this->vsRepository->create($validated);
        if ($vs) {
            return response()->json([
                'status' => 'success',
            ], Response::HTTP_CREATED);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function invited_approve(InvitedApproveRequest $request, $id)
    {
        $validated = $request->validated();
        $user = $request->user();
        $card = $validated['card'];
        $vs = $this->vsRepository->findById($id);
        if ($vs->invited_id != $request->user()->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'İşlem yaptığınız VS isteği size ait değildir.'
            ], Response::HTTP_BAD_REQUEST);
        }
        $team = $this->teamRepository->findById($vs->invited_team_id);
        //dd($validated);
        $meta = [
            'vs_id' => $id,
            'team_title' => $team->title,
            'process_type' => PayfullHelper::PROCESS_TYPE_VS_INVITED_ACCEPT,
        ];
        $meta = json_encode($meta);

        try {
            $response = PayfullHelper::request($user, $card, '0.01', $meta);
            return response()->json($response);
            //return $response->data;
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 'error',
                'file' => $ex->getFile(),
                'line' => $ex->getLine(),
                'message' => $ex->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        /*
        $team = $this->teamRepository->findById($vs->invited_team_id);
        $vs = $this->vsRepository->update_status($id, $team->title,VSStatus::INVITED_APPROVED);
        if ($vs) {
            return response()->json([
                'status' => 'success',
                'data' => $vs->status,
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        */
    }

    public function invited_reject(InvitedRejectRequest $request, $id)
    {
        $validated = $request->validated();

        $vs = $this->vsRepository->findById($id);
        $team = $this->teamRepository->findById($vs->invited_team_id);
        $vs = $this->vsRepository->update_status($id, $team->title,VSStatus::INVITED_REJECTED);
        if ($vs) {
            return response()->json([
                'status' => 'success',
                'data' => $vs->status,
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function inviter_approve(InviterApproveRequest $request, $id)
    {
        $validated = $request->validated();
        $user = $request->user();
        $vs = $this->vsRepository->findById($id);
        if ($vs->inviter_id != $request->user()->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'İşlem yaptığınız VS isteği size ait değildir.'
            ], Response::HTTP_BAD_REQUEST);
        }
        $card = $validated['card'];
        $team = $this->teamRepository->findById($vs->inviter_team_id);
        $meta = [
            'vs_id' => $id,
            'team_title' => $team->title,
            'process_type' => PayfullHelper::PROCESS_TYPE_VS_INVITER_ACCEPT,
        ];
        $meta = json_encode($meta);

        try {
            $response = PayfullHelper::request($user, $card, '0.01', $meta);
            return response()->json($response);
            //return $response->data;
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 'error',
                'file' => $ex->getFile(),
                'line' => $ex->getLine(),
                'message' => $ex->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }


        /*$team = $this->teamRepository->findById($vs->inviter_team_id);
        $vs = $this->vsRepository->update_status($id, $team->title,VSStatus::INVITER_APPROVED);
        if ($vs) {
            $this->vsReservationRepository->create($vs);
            return response()->json([
                'status' => 'success',
                'data' => $vs->status,
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
*/
    }

    public function inviter_cancel(InviterCancelRequest $request, $id)
    {
        $validated = $request->validated();
        $vs = $this->vsRepository->findById($id);
        $team = $this->teamRepository->findById($vs->inviter_team_id);
        $vs = $this->vsRepository->update_status($id, $team->title,VSStatus::INVITER_CANCELED);
        if ($vs) {
            return response()->json([
                'status' => 'success',
                'data' => $vs->status,
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
