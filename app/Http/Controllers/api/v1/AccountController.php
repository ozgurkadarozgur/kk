<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\OAuthHelper;
use App\Helpers\VatanSMS;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Account\SignInRequest;
use App\Http\Requests\Api\Account\SignUpRequest;
use App\Http\Requests\Api\Account\SignUpValidate1;
use App\Http\Requests\Api\Account\SignUpValidate2;
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
        $response = OAuthHelper::get_access_token($validated['email'], $validated['password']);
        return $response;
    }

    public function sign_up(SignUpRequest $request)
    {
        $validated = $request->validated();
        $player = $this->playerRepository->create($validated);
        if ($player) {
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

        $code = rand(10000, 99999);
        $message = 'KAFAKAFAYA SMS KODU '. $code . '.';
        $result = VatanSMS::send($validated['phone'], $message);
        if ($result) {
            return response()->json([
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'Bir hata oluştu. Lütfen daha sonra tekrar deneyin.'
            ]);
        }
    }

    public function sign_up_validate_2(SignUpValidate2 $request)
    {
        $validated = $request->validated();
        return response()->json([
            'status' => 'success',
        ]);
    }

}
