<?php

namespace App\Http\Controllers;

use App\Provider;
use App\Service;
use App\State;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::withTrashed()->paginate(15);

        return view('admin.providers.index', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.providers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $provider = Provider::create($request->all());

        return redirect()->route('providers.edit', $provider)->with('flash', 'Proveedor creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        return view('admin.providers.edit', compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $provider->update($request->all());

        return back()->with('flash', 'Proveedor actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider $provider
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Provider $provider)
    {
        $provider->state_id = State::where('abbreviation', 'gen-del')->first()->id;
        $provider->save();
        $provider->delete();

        return redirect()->route('providers.index')->with('flash', 'Proveedor eliminado correctamente');
    }
}
