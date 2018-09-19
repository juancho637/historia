<?php

namespace App\Http\Controllers\Api;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        if ($request->ajax()) {
            $clients = Client::fullName($request->search)->identification($request->search)->petName($request->search)->with('pets.breed')->get();

            $formatted_clients = [];

            foreach ($clients as $client) {
                $formatted_clients[] = [
                    'id' => $client->id,
                    'text' => $client->full_name,
                    'type_identification' => $client->type_identification,
                    'identification' => $client->identification,
                    'email' => $client->email,
                    'cell_phone' => $client->cell_phone,
                    'phone' => $client->phone,
                    'address' => $client->address,
                    'pets' => $client->pets
                ];
            }

            return response()->json($formatted_clients, 200);
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
     * @param  Request $request
     * @param  \App\Client $client
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Client $client)
    {
        if ($request->ajax()) {
            $formatted_clients = [
                'id' => $client->id,
                'text' => $client->full_name,
                'type_identification' => $client->type_identification,
                'identification' => $client->identification,
                'email' => $client->email,
                'cell_phone' => $client->cell_phone,
                'phone' => $client->phone,
                'address' => $client->address,
                'pets' => $client->pets()->with('breed')->get()
            ];

            return response()->json($formatted_clients, 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
