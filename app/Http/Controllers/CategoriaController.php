<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use App\Http\Requests\StorecategoriaRequest;
use App\Http\Requests\UpdatecategoriaRequest;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(categoria::get());
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
        $categoria=categoria::create($request->all());
        return response()->json($categoria);
    }

    /**
     * Display the specified resource.
     */
    public function show(categoria $categoria)
    {
        $categoria=categoria::find($id);
        if($categoria)
            return response()->json($categoria);
        else
        return response()->json('Usuario no Encontrado',409);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepersonalRequest $request, categoria $categoria)
    {
        $categoria=categoria::find($id);
        if($categoria){
            $categoria=$categoria->update($request->all());
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(categoria $categoria)
    {
        $categoria=categoria::find($id);
        if(!$categoria){
            return response()->json('usuario no encontrado',400);
        }
        $categoria->delete();
        return $this->index();
    }
}
