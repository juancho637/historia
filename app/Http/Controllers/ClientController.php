<?php

namespace App\Http\Controllers;

use App\Client;
use App\Neighborhood;
use App\Service;
use App\State;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = Client::fullName($request->search)->identification($request->search)->petName($request->search)->withTrashed()->paginate(15);

        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $neighborhoods = Neighborhood::all();

        return view('admin.clients.create', compact('neighborhoods'));
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
            'type_identification' => 'required',
            'identification' => 'required',
            'full_name' => 'required',
            'email' => 'required|email|unique:clients',
            'cell_phone' => 'required|max:14|min:14',
            'phone' => 'max:8|min:8',
            'address' => 'required',
            'birth_date' => 'required',
            'gender' => 'required',
        ]);

        $client = Client::create($request->all());

        return redirect()->route('clients.show', $client)->with('flash', 'Cliente creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $this->validate($request, [
            'type_identification' => 'required',
            'identification' => 'required',
            'full_name' => 'required',
            'email' => 'required|email|unique:clients,email,'.$client->id,
            'cell_phone' => 'required|max:14|min:14',
            'phone' => 'max:8|min:8',
            'address' => 'required',
            'birth_date' => 'required',
            'gender' => 'required',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.show', $client)->with('flash', 'Cliente actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client $client
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Client $client)
    {
        $client->state_id = State::where('abbreviation', 'gen-del')->first()->id;
        $client->save();
        $client->delete();

        return redirect()->route('clients.index')->with('flash', 'Cliente eliminado correctamente');
    }
}
