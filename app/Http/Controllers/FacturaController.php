<?php

namespace App\Http\Controllers;

use App\Models\factura;
use App\Http\Requests\StorefacturaRequest;
use App\Http\Requests\UpdatefacturaRequest;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(factura::get());
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
        $factura=factura::create($request->all());
        return response()->json($factura);
    }

    /**
     * Display the specified resource.
     */
    public function show(factura $factura)
    {
        $factura=factura::find($id);
        if($factura)
            return response()->json($factura);
        else
        return response()->json('Usuario no Encontrado',409);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepersonalRequest $request, factura $factura)
    {
        $factura=factura::find($id);
        if($factura){
            $factura=$factura->update($request->all());
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(factura $factura)
    {
        $factura=factura::find($id);
        if(!$factura){
            return response()->json('usuario no encontrado',400);
        }
        $factura->delete();
        return $this->index();
    }
}
