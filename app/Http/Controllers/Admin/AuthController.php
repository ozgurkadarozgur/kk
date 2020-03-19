<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Requests\Admin\LoginAdminRequest;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    private $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->middleware(AdminMiddleware::class);
        $this->userRepository = $userRepository;
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function login_attempt(LoginAdminRequest $request)
    {
        $validated = $request->validated();
        if (Auth::guard('admin')->attempt($validated)){
            return redirect()->intended();
        }
        return redirect()->back();
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.auth.login');
    }

}
