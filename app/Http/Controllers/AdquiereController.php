<?php

namespace App\Http\Controllers;

use App\Models\adquiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdquiereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consulta = DB::select('SELECT a.id as idadquiere,u.nombre as nombreuser,p.nombre as nombreproveedor,a.fecha,a.montototal  FROM users u, adquieres a, proveedors p WHERE u.id=a.user_id and a.proveedor_id=p.id');
        // return response()->json(adquiere::get());
        return response()->json($consulta);
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
        $adquiere = adquiere::create($request->all());
        $adquiere2 = adquiere::get(); //esto devuelve a la vista todos los registros creados contando el que se creeo recientemente
        return response()->json(['id' => $adquiere->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $adquiere = adquiere::find($id);
        if ($adquiere) {
            return response()->json($adquiere);
        } else {
            return response()->json('Usuario no Encontrado', 409);
        }

    }

    public function detallar($id)
    {

        $consultaa = DB::select('SELECT a.*
                            FROM adquieres a
                            WHERE a.id=:id', ['id' => $id]);
        $consultal = DB::select('SELECT l.stock as cantidad ,p.*
        FROM lotes l, adquieres a, productos p
        WHERE a.id=l.adquiere_id and p.id=l.producto_id and a.id=:id', ['id' => $id]);

        $consultap = DB::select('SELECT p.nombre,p.telefono, p.direccion,p.cinit
        FROM adquieres a, proveedors p
        WHERE p.id=a.proveedor_id and a.id=:id GROUP BY p.nombre,p.telefono, p.direccion,p.cinit ', ['id' => $id]);

        $consultau = DB::select('SELECT u.nombre
        FROM adquieres a,users u
        WHERE u.id=a.user_id and a.id=:id', ['id' => $id]);

        return response()->json([$consultaa, [$consultal], $consultap, $consultau]);
        // return response()->json($consultal);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $adquiere = adquiere::find($id);
        if ($adquiere) {
            $adquiere = $adquiere->update($request->all());
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $adquiere = adquiere::find($id);
        if (!$adquiere) {
            return response()->json('usuario no encontrado', 400);
        }
        $adquiere->delete();
        return $this->index();
    }

    // public function reporte($id)
    // {
    //     $consulta = DB::select('SELECT a.id,a.fecha,pr.nombre as proveedor,p.nombre as producto,l.stock,l.fecha_expiracion,a.montototal
    //                              FROM lotes l
    //                              JOIN adquieres a ON l.adquiere_id = a.id
    //                              JOIN proveedors pr ON a.proveedor_id = pr.id
    //                              JOIN productos p ON l.producto_id = p.id');
    //     return response()->json($consulta);
    // }

    public function reporte($dia1, $mes1, $gestion1, $dia2, $mes2, $gestion2)
    {
        // Convertir día, mes y año en una fecha
        $currentDate = "$gestion1-$mes1-$dia1";

        // Calcular la fecha límite (un mes después)
        $endDate = "$gestion2-$mes2-$dia2";

        // Ejecutar la consulta
        $consultad = DB::select('SELECT a.id,a.fecha,CONCAT(pr.nombre, " ", pr.cinit) as proveedor,CONCAT(u.nombre, " ", u.apellido) AS usuario ,p.nombre as producto,l.stock,l.fecha_expiracion,a.montototal
                                 FROM lotes l
                                 JOIN adquieres a ON l.adquiere_id = a.id
                                 JOIN proveedors pr ON a.proveedor_id = pr.id
                                 JOIN productos p ON l.producto_id = p.id
                                 JOIN users u ON a.user_id = u.id
                                 WHERE a.fecha BETWEEN :currentDate AND :endDate',
            ['currentDate' => $currentDate, 'endDate' => $endDate]);

        // Devolver los resultados en formato JSON
        return response()->json($consultad);
    }
    public function reportedeegresos($dia1, $mes1, $gestion1, $dia2, $mes2, $gestion2)
    {
        // Convertir día, mes y año en una fecha
        $currentDate = "$gestion1-$mes1-$dia1";

        // Calcular la fecha límite (un mes después)
        $endDate = "$gestion2-$mes2-$dia2";

        // Ejecutar la consulta
        $reportedeegresos = DB::select('SELECT a.id,a.fecha,CONCAT(u.nombre, " ", u.apellido) AS usuario,CONCAT(pr.nombre, " ", pr.cinit) as proveedor,p.nombre as producto,l.stock,a.montototal
                                 FROM lotes l
                                 JOIN adquieres a ON l.adquiere_id = a.id
                                 JOIN proveedors pr ON a.proveedor_id = pr.id
                                 JOIN productos p ON l.producto_id = p.id
                                 JOIN users u ON a.user_id = u.id
                                 WHERE a.fecha BETWEEN :currentDate AND :endDate',
            ['currentDate' => $currentDate, 'endDate' => $endDate]);

        $gananciatotal = DB::select('SELECT SUM(a.montototal) as montototal
                                 FROM lotes l
                                 JOIN adquieres a ON l.adquiere_id = a.id
                                 JOIN proveedors pr ON a.proveedor_id = pr.id
                                 JOIN productos p ON l.producto_id = p.id
                                 JOIN users u ON a.user_id = u.id
                                 WHERE a.fecha BETWEEN :currentDate AND :endDate',
            ['currentDate' => $currentDate, 'endDate' => $endDate]);

        // Crear una respuesta combinada
        $respuesta = [
            'reporte_egresos' => $reportedeegresos,
            'ganancia_total' => $gananciatotal,
        ];

        return response()->json($respuesta);
    }
}
