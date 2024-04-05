<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    /* public function store(Request $request) //alterar esto para que se puedan ingresar N detalles que se le mande como info a $request
    {
        $detalles = $request->detalles;

        if(empty($detalles)){
            return response()->json(['error'=>'No existen datos de almenos un detalle'],400);
        }
        try{
            Detalle::insert($detalles);
            return response()->json(['mensaje'=>'se insertaron los detalles'],400);
        }catch (\Exeption $e){
            return response()->json(['error'=>'Ocurrio un Error al aguardar los detalles']);
        }
        //si guarda uno a varios detalles pero en este formato (ejemplo de json que recibe)
        // {
        //     "detalles":[{
        //   "producto_id":"3",
        //   "cantidad":"1",
        //   "factura_id":"2"
        // },{
        //   "producto_id":"3",
        //   "cantidad":"1",
        //   "factura_id":"2"
        // }]}
        // $detalle=detalle::create($request->all());
        // $detalle2=detalle::get();//esto devuelve a la vista todos los registros creados contando el que se creeo recientemente
        // return response()->json($detalle2);
    } */

    public function store(Request $request)
    {
        $detalle=detalle::create($request->all());
        $detalle2=detalle::get();//esto devuelve a la vista todos los registros creados contando el que se creeo recientemente
        return response()->json($detalle);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(detalle $id)
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
    public function update(Request $request, $id)
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
    public function destroy($id)
    {
        $detalle=detalle::find($id);
        if(!$detalle){
            return response()->json('usuario no encontrado',400);
        }
        $detalle->delete();
        return $this->index();
    }
}
