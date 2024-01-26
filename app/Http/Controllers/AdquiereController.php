<?php

namespace App\Http\Controllers;

use App\Models\adquiere;
use App\Http\Requests\StoreadquiereRequest;
use App\Http\Requests\UpdateadquiereRequest;

class AdquiereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(adquiere::get());
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
        $adquiere=adquiere::create($request->all());
        return response()->json($adquiere);
    }

    /**
     * Display the specified resource.
     */
    public function show(adquiere $adquiere)
    {
        $adquiere=adquiere::find($id);
        if($adquiere)
            return response()->json($adquiere);
        else
        return response()->json('Usuario no Encontrado',409);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(adquiere $adquiere)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepersonalRequest $request, adquiere $adquiere)
    {
        $adquiere=adquiere::find($id);
        if($adquiere){
            $adquiere=$adquiere->update($request->all());
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(adquiere $adquiere)
    {
        $adquiere=adquiere::find($id);
        if(!$adquiere){
            return response()->json('usuario no encontrado',400);
        }
        $adquiere->delete();
        return $this->index();
    }
}
