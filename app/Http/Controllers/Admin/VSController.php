<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\IVSRepository;
use Illuminate\Http\Request;

class VSController extends Controller
{

    private $vsRepository;

    public function __construct(IVSRepository $vsRepository)
    {
        $this->vsRepository = $vsRepository;
    }

    public function index()
    {
        $vs_list = $this->vsRepository->all();
        return view('admin.vs.index', compact('vs_list'));
    }

    public function show($id)
    {
        $vs = $this->vsRepository->findById($id);
        return view('admin.vs.show', compact('vs'));
    }

}
