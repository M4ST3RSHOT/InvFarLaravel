<?php

namespace App\Http\Controllers;

use App\Models\farmacia;
use App\Http\Requests\StorefarmaciaRequest;
use App\Http\Requests\UpdatefarmaciaRequest;

class FarmaciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(farmacia::get());
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
    public function store(Request $request)
    {
        $farmacia=farmacia::create($request->all());
        $farmacia2=farmacia::get();//esto devuelve a la vista todos los registros creados contando el que se creeo recientemente
        return response()->json($farmacia2);
    }

    /**
     * Display the specified resource.
     */
    public function show(farmacia $id)
    {
        $farmacia=farmacia::find($id);
        if($farmacia)
            return response()->json($farmacia);
        else
        return response()->json('Usuario no Encontrado',409);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(farmacia $farmacia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $farmacia=farmacia::find($id);
        if($farmacia){
            $farmacia=$farmacia->update($request->all());
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $farmacia=farmacia::find($id);
        if(!$farmacia){
            return response()->json('usuario no encontrado',400);
        }
        $farmacia->delete();
        return $this->index();
    }
}
