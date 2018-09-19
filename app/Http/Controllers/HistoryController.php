<?php

namespace App\Http\Controllers;

use App\Engagement;
use App\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Engagement $engagement
     * @return void
     */
    public function index(Engagement $engagement)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Engagement $engagement
     * @return void
     */
    public function create(Engagement $engagement)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Engagement $engagement
     * @return void
     */
    public function store(Request $request, Engagement $engagement)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Engagement $engagement
     * @param  History $history
     * @return void
     */
    public function show(Engagement $engagement, History $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Engagement $engagement
     * @param  History $history
     * @return void
     */
    public function edit(Engagement $engagement, History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Engagement $engagement
     * @param  History $history
     * @return void
     */
    public function update(Request $request, Engagement $engagement, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Engagement $engagement
     * @param  History $history
     * @return void
     */
    public function destroy(Engagement $engagement, History $history)
    {
        //
    }
}
