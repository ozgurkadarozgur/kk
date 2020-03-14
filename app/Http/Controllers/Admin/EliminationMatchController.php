<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EliminationMatch\UpdatePartialEliminationMatchRequest;
use App\Repositories\Interfaces\IEliminationMatchRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EliminationMatchController extends Controller
{

    private $eliminationMatchRepository;

    public function __construct(IEliminationMatchRepository $eliminationMatchRepository)
    {
        $this->eliminationMatchRepository = $eliminationMatchRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function update_partial(UpdatePartialEliminationMatchRequest $request, $id)
    {
        $validated = $request->validated();
        if (isset($validated['start_date'])) $validated['start_date'] = Carbon::parse($validated['start_date']);
        if (isset($validated['start_time'])) $validated['start_time'] = Carbon::parse($validated['start_time'])->toTimeString();
        $this->eliminationMatchRepository->update_partial($id, $validated);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
