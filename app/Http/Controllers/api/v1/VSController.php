<?php

namespace App\Http\Controllers\api\v1;

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
use App\Rules\VS\VSApproveCheckIsPlayerInvited;
use Symfony\Component\HttpFoundation\Response;

class VSController extends Controller
{

    private $vsRepository;
    private $astroturfRepository;
    private $teamRepository;

    public function __construct(IVSRepository $vsRepository, IAstroturfRepository $astroturfRepository, ITeamRepository $teamRepository)
    {
        $this->vsRepository = $vsRepository;
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
        $vs = $this->vsRepository->findById($id);
        if ($vs->invited_id != $request->user()->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'İşlem yaptığınız VS isteği size ait değildir.'
            ], Response::HTTP_BAD_REQUEST);
        }
        //dd($validated);
        $team = $this->teamRepository->findById($vs->invited_team_id);
        $vs = $this->vsRepository->update_status($id, $team->title,VSStatus::INVITED_APPROVED);
        if ($vs) {
            return response()->json([
                'status' => 'success',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
        $vs = $this->vsRepository->findById($id);
        if ($vs->inviter_id != $request->user()->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'İşlem yaptığınız VS isteği size ait değildir.'
            ], Response::HTTP_BAD_REQUEST);
        }
        //dd($validated);
        $team = $this->teamRepository->findById($vs->inviter_team_id);
        $vs = $this->vsRepository->update_status($id, $team->title,VSStatus::INVITER_APPROVED);
        if ($vs) {
            return response()->json([
                'status' => 'success',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

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
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
