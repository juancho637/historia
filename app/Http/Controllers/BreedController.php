<?php

namespace App\Http\Controllers;

use App\Breed;
use App\Service;
use App\Species;
use App\State;
use Illuminate\Http\Request;

class BreedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @param  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, $id)
    {
        if ($request->ajax()){
            return response()->json(Breed::ofSpecies($id)->get());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Species $species
     * @return \Illuminate\Http\Response
     */
    public function create(Species $species)
    {
        return view('admin.breeds.create', compact('species'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Species $species
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Species $species)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $fields = $request->all();
        $fields['species_id'] = $species->id;

        Breed::create($fields);

        return redirect()->route('species.show', $species)->with('flash', 'Raza creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Breed  $breed
     * @return \Illuminate\Http\Response
     */
    public function show(Breed $breed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Species $species
     * @param  \App\Breed $breed
     * @return \Illuminate\Http\Response
     */
    public function edit(Species $species, Breed $breed)
    {
        return view('admin.breeds.edit', compact('species','breed'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Species $species
     * @param  \App\Breed $breed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Species $species, Breed $breed)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $breed->update($request->all());

        return redirect()->route('species.show', $species)->with('flash', 'Raza actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Species $species
     * @param  \App\Breed $breed
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Species $species, Breed $breed)
    {
        $breed->state_id = State::where('abbreviation', 'gen-del')->first()->id;
        $breed->save();
        $breed->delete();

        return redirect()->route('species.show', $species)->with('flash', 'Raza eliminada correctamente');
    }
}
