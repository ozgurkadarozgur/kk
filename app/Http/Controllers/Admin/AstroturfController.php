<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Requests\Admin\Astroturf\UpdateAstroturfRequest;
use App\Http\Requests\Admin\AstroturfCalendar\DestroyCalendarRequest;
use App\Http\Requests\Admin\AstroturfCalendar\DestroySubscribedCalendarRequest;
use App\Http\Requests\Admin\AstroturfCalendar\StoreCalendarRequest;
use App\Http\Resources\AstroturfCalendar\AstroturfCalendarResource;
use App\Models\AstroturfCalendar;
use App\Repositories\Interfaces\IAstroturfCalendarRepository;
use App\Repositories\Interfaces\IAstroturfRepository;
use App\Repositories\Interfaces\IAstroturfServiceRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AstroturfController extends Controller
{

    private $astroturfRepository;
    private $astroturfCalendarRepository;
    private $astroturfServiceRepository;

    public function __construct(IAstroturfRepository $astroturfRepository, IAstroturfCalendarRepository $astroturfCalendarRepository, IAstroturfServiceRepository $astroturfServiceRepository)
    {
        $this->middleware(AdminMiddleware::class);
        $this->astroturfRepository = $astroturfRepository;
        $this->astroturfCalendarRepository = $astroturfCalendarRepository;
        $this->astroturfServiceRepository = $astroturfServiceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $astroturfs = $this->astroturfRepository->all();
        return view('admin.astroturf.index', compact('astroturfs'));
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
        $astroturf = $this->astroturfRepository->findById($id);
        //$c = $this->astroturfCalendarRepository->findById(7);
        //dd(AstroturfCalendar::get_day(Carbon::parse($c->start_date)->WeekDay()));
        $services = $this->astroturfServiceRepository->all();
        $calendar = $this->astroturfCalendarRepository->findBySubscribeSituation(false);
        $calendar_subscribed = $this->astroturfCalendarRepository->findBySubscribeSituation(true);
        $calendar_resource = AstroturfCalendarResource::collection($calendar);
        $calendar_resource_subscribed = AstroturfCalendarResource::collection($calendar_subscribed);
        return view('admin.astroturf.show', compact('astroturf', 'calendar_resource', 'calendar_resource_subscribed', 'services'));
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
    public function update(UpdateAstroturfRequest $request, $id)
    {
        $validated = $request->validated();
        $this->astroturfRepository->update($id, $validated);
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

    public function store_calendar(StoreCalendarRequest $request, $id)
    {
        $validated = $request->validated();
        $validated['start_date'] = \DateTime::createFromFormat('D M d Y H:i:s e+', $validated['start_date']);
        $validated['end_date'] = \DateTime::createFromFormat('D M d Y H:i:s e+', $validated['end_date']);
        //dd($validated);
        $this->astroturfCalendarRepository->create($id, $validated);
        return redirect()->back();
    }

    public function destroy_calendar(DestroyCalendarRequest $request, $id)
    {
        $validated = $request->validated();
        $this->astroturfCalendarRepository->delete($validated['calendar_id']);
        return redirect()->back();
    }

    public function destroy_subscribed_calendar(DestroySubscribedCalendarRequest $request, $id)
    {
        $validated = $request->validated();
        $this->astroturfCalendarRepository->delete($validated['subscribed_calendar_id']);
        return redirect()->back();
    }

}
