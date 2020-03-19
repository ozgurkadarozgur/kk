<?php

namespace App\Http\Controllers\Facility;

use App\Http\Controllers\Controller;
use App\Http\Middleware\FacilityMiddleware;
use App\Http\Requests\Facility\Auth\LoginFacilityRequest;
use App\Repositories\Interfaces\IFacilityUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $facilityUserRepository;

    public function __construct(IFacilityUserRepository $facilityUserRepository)
    {
        $this->middleware(FacilityMiddleware::class);
        $this->facilityUserRepository = $facilityUserRepository;
    }

    public function login()
    {
        return view('facility.auth.login');
    }

    public function login_attempt(LoginFacilityRequest $request)
    {
        $validated = $request->validated();
        if (Auth::guard('facility')->attempt($validated)){
            return redirect()->intended();
        }
        return redirect()->back();
    }

    public function logout()
    {
        Auth::guard('facility')->logout();
        return redirect()->route('facility.auth.login');
    }
}
