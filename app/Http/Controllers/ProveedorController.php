<?php

namespace App\Http\Controllers;

use App\Models\proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function store(Request $request)
    {
        $proveedor = proveedor::create($request->all());
        $proveedor2 = proveedor::get(); //esto devuelve a la vista todos los registros creados contando el que se creeo recientemente

        return response()->json($proveedor2);
    }

    /**
     * Display the specified resource.
     */
    public function show(proveedor $id)
    {
        $proveedor = proveedor::find($id);
        if ($proveedor) {
            return response()->json($proveedor);
        } else {
            return response()->json('Usuario no Encontrado', 409);
        }

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
    public function update(Request $request, $id)
    {
        $proveedor = proveedor::find($id);
        if ($proveedor) {
            $proveedor = $proveedor->update($request->all());
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proveedor = proveedor::find($id);
        if (!$proveedor) {
            return response()->json('usuario no encontrado', 400);
        }
        $proveedor->delete();
        return $this->index();
    }

    public function productos($id)
    {

        $consultad = DB::select('SELECT pr.nombre,pr.codigo,pr.descripcion,pr.unidad,pr.peso,pr.imagen
        FROM productos pr, lotes l, adquieres a
        WHERE pr.id=l.producto_id and l.adquiere_id=a.id and a.proveedor_id=:id
        group by pr.nombre,pr.codigo,pr.descripcion,pr.unidad,pr.peso,pr.imagen', ['id' => $id]);

        return response()->json($consultad);
    }

}
