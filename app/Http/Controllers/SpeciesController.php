<?php

namespace App\Http\Controllers;

use App\Service;
use App\Species;
use App\State;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $species = Species::withTrashed()->paginate(15);

        return view('admin.species.index', compact('species'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.species.create');
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

        $species = Species::create($request->all());

        return redirect()->route('species.show', $species)->with('flash', 'Especie creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function show(Species $species)
    {
        return view('admin.species.show', compact('species'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function edit(Species $species)
    {
        return view('admin.species.edit', compact('species'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Species $species)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $species->update($request->all());

        return redirect()->route('species.show', $species)->with('flash', 'Especie actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Species  $species
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Species $species)
    {
        $species->state_id = State::where('abbreviation', 'gen-del')->first()->id;
        $species->save();
        $species->delete();

        return redirect()->route('species.index')->with('flash', 'Especie eliminada correctamente');
    }
}
