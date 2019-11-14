<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.index', [
            'clients' => Client::paginate(50),
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return $this->edit($client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('client.edit', [
            'client'  => $client,
        ]);
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
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:80'],
            'surname' => ['required', 'string', 'max:150'],
            'date-of-birth' => ['required', 'date'],
            'country' => ['required', 'string'],
            'address' => ['required', 'string'],
            'email' => "required|string|email|max:255|unique:clients,email," . $client->id,
            'phone-number' => ['required', 'string', 'regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}/i'],
        ])->validate();

        $client->name = $request['name'];
        $client->surname = $request['surname'];
        $client->{'date-of-birth'} = $request['date-of-birth'];
        $client->country = $request['country'];
        $client->address = $request['address'];
        $client->email = $request['email'];
        $client->{'phone-number'} = $request['phone-number'];
        $client->save();

        return redirect()->route('client.index');
    }
}
