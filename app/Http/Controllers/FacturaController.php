<?php

namespace App\Http\Controllers;

use App\Models\factura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{

    public function index()
    {

        $consulta = DB::select('SELECT f.id as idfactura,f.fecha,f.subtotal,f.descuento,f.total,u.nombre As nombreusuario , c.nombre as nombrecliente ,c.apellido as apellidocliente,c.ci as cicliente FROM users u, clientes c, facturas f WHERE u.id=f.user_id and c.id=f.cliente_id');
        // $consulta=DB::select('SELECT f.*,u.*,c.* FROM users u, clientes c, facturas f' ) ;
        // return response()->json(factura::get());
        return response()->json($consulta);
    }

    public function detallar($id)
    {

        $consultaf = DB::select('SELECT f.*
                            FROM facturas f
                            WHERE f.id=:id', ['id' => $id]);
        $consultad = DB::select('SELECT d.cantidad,p.nombre,p.descripcion,p.peso,p.unidad,p.precio_venta
        FROM detalles d, facturas f, productos p
        WHERE f.id=d.factura_id and p.id=d.producto_id and f.id=:id', ['id' => $id]);

        $consultac = DB::select('SELECT c.nombre,c.apellido, c.ci
        FROM productos p, detalles d, facturas f,clientes c
        WHERE c.id=f.cliente_id and f.id=d.factura_id and d.producto_id=p.id and f.id=:id GROUP BY c.nombre,c.apellido, c.ci', ['id' => $id]);

        $consultau = DB::select('SELECT u.nombre
        FROM facturas f,users u
        WHERE u.id=f.user_id and f.id=:id', ['id' => $id]);

        return response()->json([$consultaf, [$consultad], $consultac, $consultau]);
    }

    // public function detalledeventa_detalle($id){

    //     // $consulta=DB::select('SELECT d.id,d.codigo,concat(p.nombre," ",t.descripcion ," ", d.descripcion) as descripcion,d.stock,d.precio_compra,d.precio_venta,d.cantidad_minima FROM products p,tipos t,detalles d WHERE t.id_producto=p.id and d.id_tipo=t.id and p.lugar=:id',['id'=> $id]);
    //     // return response()->json($consulta);
    //     $consulta=DB::select('SELECT d.* FROM productos p, detalles d, facturas f WHERE d.producto_id=p.id and d.factura_id=f.id and f.id=:id',['id'=> $id]);
    //     return response()->json($consulta);
    // }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $factura = factura::create($request->all());
        $factura2 = factura::get(); //esto devuelve a la vista todos los registros creados contando el que se creeo recientemente
        return response()->json(['id' => $factura->id]); //especificamente esta devolviendo el id de la factura que se esta creando

    }

    public function show(factura $id)
    {
        $factura = factura::find($id);
        if ($factura) {
            return response()->json($factura);
        } else {
            return response()->json('Usuario no Encontrado', 409);
        }

    }

    public function edit(factura $factura)
    {
        //
    }

    public function update(Request $request, factura $id)
    {
        $factura = factura::find($id);
        if ($factura) {
            $factura = $factura->update($request->all());
        }
        return $this->index();
    }

    public function destroy($id)
    {
        $factura = factura::find($id);
        if (!$factura) {
            return response()->json('usuario no encontrado', 400);
        }
        $factura->delete();
        return $this->index();
    }
    public function reporte($dia1, $mes1, $gestion1, $dia2, $mes2, $gestion2)
    {
        // Convertir día, mes y año en una fecha
        $currentDate = "$gestion1-$mes1-$dia1";

        // Calcular la fecha límite (un mes después)
        $endDate = "$gestion2-$mes2-$dia2";

        // Ejecutar la consulta
        $consultad = DB::select('SELECT f.id,f.fecha,c.nombre,c.apellido,p.nombre as producto,d.cantidad,f.descuento,f.total
                                 FROM detalles d,facturas f,clientes c,productos p
                                 WHERE f.id=d.factura_id and c.id=f.cliente_id and p.id=d.producto_id
                                 AND f.fecha BETWEEN :currentDate AND :endDate',
            ['currentDate' => $currentDate, 'endDate' => $endDate]);
        // Devolver los resultados en formato JSON

        // $consultad=DB::select('SELECT p.nombre as name,sum(d.cantidad) as value
        // FROM detalles d, facturas f, productos p
        // WHERE f.id=d.factura_id and p.id=d.producto_id and Day(f.fecha)>=:dia-7 and Month(f.fecha)=:mes and Year(f.fecha)=:gestion
        // GROUP BY p.nombre',['dia' => $dia,'mes' => $mes, 'gestion' => $gestion]);

        return response()->json($consultad);
    }

}
