<?php

namespace App\Http\Controllers\Api;

use App\Engagement;
use App\Service;
use App\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EngagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if($request->type === 'engagementCalendar'){
                switch ($request->action){
                    case 'back':
                        $date = date('Y-m-d' , strtotime ('-1 day' , strtotime($request->date)));
                        break;
                    case 'next':
                        $date = date('Y-m-d' , strtotime ('+1 day' , strtotime($request->date)));
                        break;
                    case 'today':
                        $date = date('Y-m-d');
                        break;
                }

                $engagements = Engagement::byBetweenDates($date, $date)->get();
                $engagementCalendarSearch = false;

                return response()->json(view('admin.engagements.partials.trEngagementTemplate', compact('engagements', 'engagementCalendarSearch'))->render());
            }

            if($request->type === 'engagementCalendarSearch'){
                if (!empty($request->dates)) {
                    $dates = explode(' - ', $request->dates);

                    $engagements_dates = Engagement::byBetweenDates($dates[0], $dates[1])
                        ->byClient($request->client)
                        ->byService($request->service_id)
                        ->byUser($request->user_id)
                        ->get()
                        ->groupBy('date');

                    $engagementCalendarSearch = true;

                    return response()->json(view('admin.engagements.partials.trEngagementTemplate', compact('engagements_dates', 'engagementCalendarSearch'))->render());
                }
            }

        }
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
     * @param  \App\Engagement  $engagement
     * @return \Illuminate\Http\Response
     */
    public function show(Engagement $engagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Engagement  $engagement
     * @return \Illuminate\Http\Response
     */
    public function edit(Engagement $engagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Engagement  $engagement
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function update(Request $request, Engagement $engagement)
    {
        if ($request->ajax()) {
            if($request->type === 'updateEngagement'){
                if ($request->has('state')){
                    $state = State::where('abbreviation', '=', $request->state)->firstOrFail();
                    $engagement->state_id = $state->id;
                }

                $engagement->save();

                return response()->json(view('admin.engagements.partials.tdEngagementTemplate', compact('engagement'))->render());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @param  \App\Engagement $engagement
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, Engagement $engagement)
    {
        foreach ($engagement->detailEngagements as $detailEngagement){
            $detailEngagement->users()->detach();
            $detailEngagement->delete();
        }

        $engagement->state_id = State::where('abbreviation', 'gen-del')->first()->id;
        $engagement->deleted_reason = $request->reason;
        $engagement->save();
        $engagement->delete();

        return response()->json($engagement, 200);
    }
}
