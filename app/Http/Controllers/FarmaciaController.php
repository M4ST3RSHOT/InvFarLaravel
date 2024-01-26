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
    public function store(StorepersonalRequest $request)
    {
        $request['password']=Hash::make($request['password']);
        $farmacia=farmacia::create($request->all());
        return response()->json($farmacia);
    }

    /**
     * Display the specified resource.
     */
    public function show(farmacia $farmacia)
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
    public function update(UpdatepersonalRequest $request, farmacia $farmacia)
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
    public function destroy(farmacia $farmacia)
    {
        $farmacia=farmacia::find($id);
        if(!$farmacia){
            return response()->json('usuario no encontrado',400);
        }
        $farmacia->delete();
        return $this->index();
    }
}
