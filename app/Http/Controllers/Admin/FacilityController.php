<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Facility\StoreFacilityAstoturfRequest;
use App\Http\Requests\Admin\Facility\StoreFacilityRequest;
use App\Repositories\Interfaces\IAstroturfRepository;
use App\Repositories\Interfaces\IAstroturfServiceRepository;
use App\Repositories\Interfaces\IFacilityRepository;
use Illuminate\Http\Request;

class FacilityController extends Controller
{

    private $facilityRepository;
    private $astroturfRepository;
    private $astroturfServiceRepository;

    public function __construct(IFacilityRepository $facilityRepository, IAstroturfRepository $astroturfRepository, IAstroturfServiceRepository $astroturfServiceRepository)
    {
        $this->facilityRepository = $facilityRepository;
        $this->astroturfRepository = $astroturfRepository;
        $this->astroturfServiceRepository = $astroturfServiceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facilities = $this->facilityRepository->all();
        return view('admin.facility.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.facility.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFacilityRequest $request)
    {
        $validated = $request->validated();
        $this->facilityRepository->create($validated);
        return redirect()->route('admin.facility.index');
    }

    public function store_astroturf(StoreFacilityAstoturfRequest $request, $id)
    {
        $validated = $request->validated();
        $validated['facility_id'] = $id;
        $this->astroturfRepository->create($validated);
        return redirect()->route('admin.facility.show', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $facility = $this->facilityRepository->findById($id);
        $services = $this->astroturfServiceRepository->all();
        return view('admin.facility.show', compact('facility', 'services'));
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
