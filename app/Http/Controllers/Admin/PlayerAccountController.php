<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Account\ResetPasswordRequest;
use App\Repositories\Interfaces\IPlayerPasswordResetRepository;
use App\Repositories\Interfaces\IPlayerRepository;
use Illuminate\Http\Request;

class PlayerAccountController extends Controller
{

    private $playerRepository;
    private $playerPasswordResetRepository;

    public function __construct(IPlayerPasswordResetRepository $playerPasswordResetRepository, IPlayerRepository $playerRepository)
    {
        $this->playerPasswordResetRepository = $playerPasswordResetRepository;
        $this->playerRepository = $playerRepository;
    }

    public function reset_password_view($token)
    {
        $password_reset = $this->playerPasswordResetRepository->findByToken($token);
        if ($password_reset) {
            return view('api.reset_password', compact('token'));
        } else {
            $status = 'error';
            return view('api.reset_password_result', compact('status'));
        }
    }

    public function reset_password(ResetPasswordRequest $request, $token)
    {
        $validated = $request->validated();
        $password_reset = $this->playerPasswordResetRepository->findByToken($token);
        if ($password_reset) {
            $player = $this->playerRepository->findByEmail($password_reset->email);
            if ($player) {
                $new_password = bcrypt($validated['new_password']);
                $this->playerRepository->resetPassword($player, $new_password);
                return redirect()->route('api.player.reset_password_result', 'success');
            }
        }
        return redirect()->route('api.player.reset_password_result', 'error');
    }

    public function reset_password_result($status)
    {
        return view('api.reset_password_result', compact('status'));
    }
}
