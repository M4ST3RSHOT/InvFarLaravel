<?php

namespace App\Http\Controllers;

use App\Models\lote;
use App\Http\Requests\StoreloteRequest;
use App\Http\Requests\UpdateloteRequest;

class LoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(lote::get());
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
        $lote=lote::create($request->all());
        $lote2=lote::get();//esto devuelve a la vista todos los registros creados contando el que se creeo recientemente
        return response()->json($lote2);
    }

    /**
     * Display the specified resource.
     */
    public function show(lote $id)
    {
        $lote=lote::find($id);
        if($lote)
            return response()->json($lote);
        else
        return response()->json('Usuario no Encontrado',409);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lote $lote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $lote=lote::find($id);
        if($lote){
            $lote=$lote->update($request->all());
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lote=lote::find($id);
        if(!$lote){
            return response()->json('usuario no encontrado',400);
        }
        $lote->delete();
        return $this->index();
    }
}
