<?php

namespace App\Http\Controllers;

use App\Models\proveedor;
use App\Http\Requests\StoreproveedorRequest;
use App\Http\Requests\UpdateproveedorRequest;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(proveedor::get());
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
        $proveedor=proveedor::create($request->all());
        return response()->json($proveedor);
    }

    /**
     * Display the specified resource.
     */
    public function show(proveedor $proveedor)
    {
        $proveedor=proveedor::find($id);
        if($proveedor)
            return response()->json($proveedor);
        else
        return response()->json('Usuario no Encontrado',409);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(proveedor $proveedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepersonalRequest $request, proveedor $proveedor)
    {
        $proveedor=proveedor::find($id);
        if($proveedor){
            $proveedor=$proveedor->update($request->all());
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(proveedor $proveedor)
    {
        $proveedor=proveedor::find($id);
        if(!$proveedor){
            return response()->json('usuario no encontrado',400);
        }
        $proveedor->delete();
        return $this->index();
    }
}
