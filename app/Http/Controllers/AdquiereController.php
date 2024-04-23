<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        $adquiere=adquiere::create($request->all());
        $adquiere2=adquiere::get();//esto devuelve a la vista todos los registros creados contando el que se creeo recientemente
        return response()->json(['id' => $adquiere->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(adquiere $id)
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
    public function update(Request $request, $id)
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
    public function destroy($id)
    {
        $adquiere=adquiere::find($id);
        if(!$adquiere){
            return response()->json('usuario no encontrado',400);
        }
        $adquiere->delete();
        return $this->index();
    }
}
