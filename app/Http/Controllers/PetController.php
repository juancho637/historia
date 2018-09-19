<?php

namespace App\Http\Controllers;

use App\Client;
use App\Pet;
use App\Service;
use App\Species;
use App\State;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        if ($request->ajax()){
            return response()->json(Pet::ofClient($id)->with('breed')->get());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Client $client
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client)
    {
        $species = Species::all();

        return view('admin.pets.create', compact('client', 'species'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Client $client
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Client $client)
    {
        $this->validate($request, [
            'name' => 'required',
            'weight' => 'required|numeric',
            'reproductive_status' => 'required',
            'birth_date' => 'required|date',
            'gender' => 'required',
            'breed_id' => 'required',
        ]);

        $pet = Pet::create($request->all());

        $pet->clients()->sync($client->id);

        return redirect()->route('clients.show', $client)->with('flash', 'Mascota creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client $client
     * @param  \App\Pet $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client, Pet $pet)
    {
        return view('admin.pets.show', compact('client', 'pet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client $client
     * @param  \App\Pet $pet
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client, Pet $pet)
    {
        $species = Species::all();

        return view('admin.pets.edit', compact('client', 'pet', 'species'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Client $client
     * @param  \App\Pet $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client, Pet $pet)
    {
        $this->validate($request, [
            'name' => 'required',
            'weight' => 'required|numeric',
            'reproductive_status' => 'required',
            'birth_date' => 'required|date',
            'gender' => 'required',
            'breed_id' => 'required',
        ]);

        $pet->update($request->all());

        return redirect()->route('clients.show', $client)->with('flash', 'Mascota actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client $client
     * @param  \App\Pet $pet
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Client $client, Pet $pet)
    {
        $pet->state_id = State::where('abbreviation', 'gen-del')->first()->id;
        $pet->save();
        $pet->delete();

        return redirect()->route('clients.show', $client)->with('flash', 'Mascota eliminada correctamente');
    }
}
