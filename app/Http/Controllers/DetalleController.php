<?php

namespace App\Http\Controllers;

use App\Models\detalle;
use App\Http\Requests\StoredetalleRequest;
use App\Http\Requests\UpdatedetalleRequest;

class DetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(detalle::get());
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
        $detalle=detalle::create($request->all());
        return response()->json($detalle);
    }

    /**
     * Display the specified resource.
     */
    public function show(detalle $detalle)
    {
        $detalle=detalle::find($id);
        if($detalle)
            return response()->json($detalle);
        else
        return response()->json('Usuario no Encontrado',409);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detalle $detalle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepersonalRequest $request, detalle $detalle)
    {
        $detalle=detalle::find($id);
        if($detalle){
            $detalle=$detalle->update($request->all());
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detalle $detalle)
    {
        $detalle=detalle::find($id);
        if(!$detalle){
            return response()->json('usuario no encontrado',400);
        }
        $detalle->delete();
        return $this->index();
    }
}
