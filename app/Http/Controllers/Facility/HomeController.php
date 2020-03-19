<?php

namespace App\Http\Controllers\Facility;

use App\Http\Controllers\Controller;
use App\Http\Middleware\FacilityMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(FacilityMiddleware::class);
    }

    public function index()
    {
        $facility = Auth::guard('facility')->user()->facility;
        return view('facility.home', compact('facility'));
    }
}
