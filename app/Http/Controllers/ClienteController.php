<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Http\Requests\StoreclienteRequest;
use App\Http\Requests\UpdateclienteRequest;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(cliente::get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepersonalRequest $request)
    {
        $request['password']=Hash::make($request['password']);
        $cliente=cliente::create($request->all());
        return response()->json($cliente);
    }

    /**
     * Display the specified resource.
     */
    public function show(cliente $cliente)
    {
        $cliente=cliente::find($id);
        if($cliente)
            return response()->json($cliente);
        else
        return response()->json('Usuario no Encontrado',409);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepersonalRequest $request, cliente $cliente)
    {
        $cliente=cliente::find($id);
        if($cliente){
            $cliente=$cliente->update($request->all());
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cliente $cliente)
    {
        $cliente=cliente::find($id);
        if(!$cliente){
            return response()->json('usuario no encontrado',400);
        }
        $cliente->delete();
        return $this->index();
    }
}
