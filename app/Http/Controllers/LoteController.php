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
    public function store(StorepersonalRequest $request)
    {
        $request['password']=Hash::make($request['password']);
        $lote=lote::create($request->all());
        return response()->json($lote);
    }

    /**
     * Display the specified resource.
     */
    public function show(lote $lote)
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
    public function update(UpdatepersonalRequest $request, lote $lote)
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
    public function destroy(lote $lote)
    {
        $lote=lote::find($id);
        if(!$lote){
            return response()->json('usuario no encontrado',400);
        }
        $lote->delete();
        return $this->index();
    }
}
