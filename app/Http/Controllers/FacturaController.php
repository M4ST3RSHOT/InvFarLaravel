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

    public function detallarpdf($id)
    {

        $consultaf = DB::select('SELECT f.*
                            FROM facturas f
                            WHERE f.id=:id', ['id' => $id]);
        $consultad = DB::select('SELECT d.cantidad,p.nombre,p.codigo,p.descripcion,p.peso,p.unidad,p.precio_venta
        FROM detalles d, facturas f, productos p
        WHERE f.id=d.factura_id and p.id=d.producto_id and f.id=:id', ['id' => $id]);

        $consultac = DB::select('SELECT c.nombre,c.apellido, c.ci
        FROM productos p, detalles d, facturas f,clientes c
        WHERE c.id=f.cliente_id and f.id=d.factura_id and d.producto_id=p.id and f.id=:id GROUP BY c.nombre,c.apellido, c.ci', ['id' => $id]);

        $consultau = DB::select('SELECT u.nombre,u.apellido
        FROM facturas f,users u
        WHERE u.id=f.user_id and f.id=:id', ['id' => $id]);

        $respuesta = [
            'consulta_factura' => $consultaf,
            'consulta_detalle' => $consultad,
            'consulta_cliente' => $consultac,
            'consulta_usuario' => $consultau,
        ];

        return response()->json($respuesta);
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
        $consultad = DB::select('SELECT f.id,f.fecha,CONCAT(c.nombre, " ", c.apellido, " ",c.ci) AS cliente,CONCAT(u.nombre, " ", u.apellido) AS usuario,p.nombre as producto,d.cantidad,f.descuento,f.total
                                 FROM users u,detalles d,facturas f,clientes c,productos p
                                 WHERE f.id=d.factura_id and c.id=f.cliente_id and p.id=d.producto_id and u.id=f.user_id
                                 AND f.fecha BETWEEN :currentDate AND :endDate',
            ['currentDate' => $currentDate, 'endDate' => $endDate]);
        return response()->json($consultad);
    }
    public function ventasporusuario($dia1, $mes1, $gestion1, $dia2, $mes2, $gestion2, $ci)
    {
        // Convertir día, mes y año en una fecha
        $currentDate = "$gestion1-$mes1-$dia1";

        // Calcular la fecha límite (un mes después)
        $endDate = "$gestion2-$mes2-$dia2";

        // Ejecutar la consulta
        $consultad = DB::select('SELECT CONCAT(u.nombre, " ", u.apellido) AS usuario, u.ci,f.id,f.fecha,p.nombre,f.descuento,f.total
                                 FROM users u,detalles d,facturas f,clientes c,productos p
                                 WHERE f.id=d.factura_id and c.id=f.cliente_id and p.id=d.producto_id and u.id=f.user_id
                                 AND f.fecha BETWEEN :currentDate AND :endDate and u.ci=:ci',
            ['currentDate' => $currentDate, 'endDate' => $endDate, 'ci' => $ci]);
        return response()->json($consultad);
    }

    public function reportedeingresos($dia1, $mes1, $gestion1, $dia2, $mes2, $gestion2)
    {
        // Convertir día, mes y año en una fecha
        $currentDate = "$gestion1-$mes1-$dia1";

        // Calcular la fecha límite (un mes después)
        $endDate = "$gestion2-$mes2-$dia2";

        // Ejecutar la consulta
        $reportedeingresos = DB::select('SELECT f.id,f.fecha,CONCAT(u.nombre, " ", u.apellido) AS usuario,p.nombre as producto,d.cantidad,f.subtotal,f.descuento,f.total
                                 FROM users u,detalles d,facturas f,clientes c,productos p
                                 WHERE f.id=d.factura_id and c.id=f.cliente_id and p.id=d.producto_id and u.id=f.user_id
                                 AND f.fecha BETWEEN :currentDate AND :endDate',
            ['currentDate' => $currentDate, 'endDate' => $endDate]);

        $gananciatotal = DB::select('SELECT SUM(f.subtotal) as subtotal , SUM(f.total) as total
                                 FROM users u,detalles d,facturas f,clientes c,productos p
                                 WHERE f.id=d.factura_id and c.id=f.cliente_id and p.id=d.producto_id and u.id=f.user_id
                                 AND f.fecha BETWEEN :currentDate AND :endDate',
            ['currentDate' => $currentDate, 'endDate' => $endDate]);

        // Crear una respuesta combinada
        $respuesta = [
            'reporte_ingresos' => $reportedeingresos,
            'ganancia_total' => $gananciatotal,
        ];

        return response()->json($respuesta);
    }

    public function reporteeconomicogeneral($dia1, $mes1, $gestion1, $dia2, $mes2, $gestion2)
    {
        // Convertir día, mes y año en una fecha
        $currentDate = "$gestion1-$mes1-$dia1";

        // Calcular la fecha límite (un mes después)
        $endDate = "$gestion2-$mes2-$dia2";

        // Ejecutar la consulta
        $reportedeingresos = DB::select('SELECT f.id,f.fecha,CONCAT(u.nombre, " ", u.apellido) AS usuario,p.nombre as producto,d.cantidad,f.subtotal,f.descuento,f.total
                                 FROM users u,detalles d,facturas f,clientes c,productos p
                                 WHERE f.id=d.factura_id and c.id=f.cliente_id and p.id=d.producto_id and u.id=f.user_id
                                 AND f.fecha BETWEEN :currentDate AND :endDate',
            ['currentDate' => $currentDate, 'endDate' => $endDate]);

        $gananciatotalingresos = DB::select('SELECT SUM(f.subtotal) as subtotal , SUM(f.total) as total
                                 FROM users u,detalles d,facturas f,clientes c,productos p
                                 WHERE f.id=d.factura_id and c.id=f.cliente_id and p.id=d.producto_id and u.id=f.user_id
                                 AND f.fecha BETWEEN :currentDate AND :endDate',
            ['currentDate' => $currentDate, 'endDate' => $endDate]);

        $reportedeegresos = DB::select('SELECT a.id,a.fecha,CONCAT(u.nombre, " ", u.apellido) AS usuario,CONCAT(pr.nombre, " ", pr.cinit) as proveedor,p.nombre as producto,l.stock,a.montototal
                                 FROM lotes l
                                 JOIN adquieres a ON l.adquiere_id = a.id
                                 JOIN proveedors pr ON a.proveedor_id = pr.id
                                 JOIN productos p ON l.producto_id = p.id
                                 JOIN users u ON a.user_id = u.id
                                 WHERE a.fecha BETWEEN :currentDate AND :endDate',
            ['currentDate' => $currentDate, 'endDate' => $endDate]);

        $gananciatotalegresos = DB::select('SELECT SUM(a.montototal) as montototal
                                 FROM lotes l
                                 JOIN adquieres a ON l.adquiere_id = a.id
                                 JOIN proveedors pr ON a.proveedor_id = pr.id
                                 JOIN productos p ON l.producto_id = p.id
                                 JOIN users u ON a.user_id = u.id
                                 WHERE a.fecha BETWEEN :currentDate AND :endDate',
            ['currentDate' => $currentDate, 'endDate' => $endDate]);

        // Crear una respuesta combinada
        $respuesta = [
            'reporte_ingresos' => $reportedeingresos,
            'reporte_egresos' => $reportedeegresos,
            'ganancia_total_ingresos' => $gananciatotalingresos,
            'ganancia_total_egresos' => $gananciatotalegresos,
        ];

        return response()->json($respuesta);
    }

}
