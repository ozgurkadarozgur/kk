<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\OAuthHelper;
use App\Helpers\VatanSMS;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Account\SignInRequest;
use App\Http\Requests\Api\Account\SignUpRequest;
use App\Http\Requests\Api\Account\SignUpValidate1;
use App\Http\Requests\Api\Account\SignUpValidate2;
use App\Jobs\SendSMSJob;
use App\Repositories\Interfaces\IPlayerRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller
{
    private $playerRepository;

    public function __construct(IPlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function sign_in(SignInRequest $request)
    {
        $validated = $request->validated();
        $access_token = OAuthHelper::get_access_token($validated['email'], $validated['password']);
        if ($access_token) {
            $player = $this->playerRepository->findByEmail($validated['email']);
            $code = rand(10000, 99999);
            $message = 'KAFAKAFAYA SMS KODU '. $code . '.';
            SendSMSJob::dispatch($player->phone, $message);
            return response()->json([
                'status' => 'success',
                'data' => [
                    'access_token' => $access_token,
                    'phone_confirmed' => $player->phone_confirmed,
                ],
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Bilgilerinizi kontrol ederek tekrar giriş yapın.'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function sign_up(SignUpRequest $request)
    {
        $validated = $request->validated();
        $player = $this->playerRepository->create($validated);
        if ($player) {
            $code = $code = rand(100000, 999999);;
            $player->phone_code = $code;
            $player->save();
            return response()->json([
                'status' => 'success'
            ], Response::HTTP_CREATED);
        } else {
            return response()->json([
                'status'=> 'error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function sign_up_validate_1(SignUpValidate1 $request)
    {
        $validated = $request->validated();
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function sign_up_validate_2(SignUpValidate2 $request)
    {
        $validated = $request->validated();
        return response()->json([
            'status' => 'success',
        ]);
    }

}
