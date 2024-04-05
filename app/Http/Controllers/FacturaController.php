<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\factura;
use App\Models\detalle;
use App\Models\producto;
use App\Http\Requests\StorefacturaRequest;
use App\Http\Requests\UpdatefacturaRequest;
use Illuminate\Support\Facades\DB;

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
    public function store(Request $request)
    {
        $factura=factura::create($request->all());
        $factura2=factura::get();//esto devuelve a la vista todos los registros creados contando el que se creeo recientemente
        return response()->json(['id' => $factura->id]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(factura $id)
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
    public function update(Request $request, factura $id)
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
    public function destroy( $id)
    {
        $factura=factura::find($id);
        if(!$factura){
            return response()->json('usuario no encontrado',400);
        }
        $factura->delete();
        return $this->index();
    }

    public function detalledeventa_producto(){

        // $consulta=DB::select('SELECT d.id,d.codigo,concat(p.nombre," ",t.descripcion ," ", d.descripcion) as descripcion,d.stock,d.precio_compra,d.precio_venta,d.cantidad_minima FROM products p,tipos t,detalles d WHERE t.id_producto=p.id and d.id_tipo=t.id and p.lugar=:id',['id'=> $id]);
        // return response()->json($consulta);
        $consulta=DB::select('SELECT p.nombre FROM productos p, detalles d, facturas f WHERE d.producto_id=p.id and d.factura_id=f.id and f.id=1');
        return response()->json($consulta);
    }

    public function detalledeventa_detalle($id){

        // $consulta=DB::select('SELECT d.id,d.codigo,concat(p.nombre," ",t.descripcion ," ", d.descripcion) as descripcion,d.stock,d.precio_compra,d.precio_venta,d.cantidad_minima FROM products p,tipos t,detalles d WHERE t.id_producto=p.id and d.id_tipo=t.id and p.lugar=:id',['id'=> $id]);
        // return response()->json($consulta);
        $consulta=DB::select('SELECT d.* FROM productos p, detalles d, facturas f WHERE d.producto_id=p.id and d.factura_id=f.id and f.id=:id',['id'=> $id]);
        return response()->json($consulta);
    }

    public function detalledeventa_personal($id){

        // $consulta=DB::select('SELECT d.id,d.codigo,concat(p.nombre," ",t.descripcion ," ", d.descripcion) as descripcion,d.stock,d.precio_compra,d.precio_venta,d.cantidad_minima FROM products p,tipos t,detalles d WHERE t.id_producto=p.id and d.id_tipo=t.id and p.lugar=:id',['id'=> $id]);
        // return response()->json($consulta);
        $consulta=DB::select('SELECT p.* FROM personals p, facturas f WHERE f.personal_id=p.id and f.id=:id',['id'=> $id]);
        return response()->json($consulta);
    }

    public function detalledeventa_factura($id){

        // $consulta=DB::select('SELECT d.id,d.codigo,concat(p.nombre," ",t.descripcion ," ", d.descripcion) as descripcion,d.stock,d.precio_compra,d.precio_venta,d.cantidad_minima FROM products p,tipos t,detalles d WHERE t.id_producto=p.id and d.id_tipo=t.id and p.lugar=:id',['id'=> $id]);
        // return response()->json($consulta);
        $consulta=DB::select('SELECT f.* FROM facturas f WHERE f.id=:id',['id'=> $id]);
        return response()->json($consulta);
    }
    

}
