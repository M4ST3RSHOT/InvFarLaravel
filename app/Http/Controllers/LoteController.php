<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lote;
use App\Http\Requests\StoreloteRequest;
use App\Http\Requests\UpdateloteRequest;
use Illuminate\Support\Facades\DB;

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
    public function store(Request $request)
    {
        $lote=lote::create($request->all());
        $lote2=lote::get();//esto devuelve a la vista todos los registros creados contando el que se creeo recientemente
        return response()->json($lote2);
    }

    /**
     * Display the specified resource.
     */
    public function show(lote $id)
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
    public function update(Request $request, $id)
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
    public function destroy($id)
    {
        $lote=lote::find($id);
        if(!$lote){
            return response()->json('usuario no encontrado',400);
        }
        $lote->delete();
        return $this->index();
    }

//     public function productosporvencer($dia,$mes,$gestion)
//     {   

//         // $consultad=DB::select('SELECT p.nombre,c.nombre as categoria,p.peso,p.unidad,l.fecha_expiracion
//         // FROM lotes l,productos p, categorias c
//         // WHERE l.producto_id=p.id and p.categoria_id=c.id and Day(l.fecha_expiracion) 
//         // between :dia and (:dia+31) and Month(l.fecha_expiracion)=:mes and Year(l.fecha_expiracion)=:gestion',['dia' => $dia,'mes' => $mes, 'gestion' => $gestion]);

// $consultad = DB::select('SELECT p.nombre, c.nombre as categoria, p.peso, p.unidad, l.fecha_expiracion
// FROM lotes l
// JOIN productos p ON l.producto_id = p.id
// JOIN categorias c ON p.categoria_id = c.id
// WHERE DAY(l.fecha_expiracion)>=:dia AND DAY(l.fecha_expiracion)<32
// AND MONTH(l.fecha_expiracion) = :mes 
// AND YEAR(l.fecha_expiracion) = :gestion',
// ['dia' => $dia, 'mes' => $mes, 'gestion' => $gestion]);

//         return response()->json($consultad);
//     }

    public function productosporvencer($dia, $mes, $gestion)
{
    // Convertir día, mes y año en una fecha
    $currentDate = "$gestion-$mes-$dia";

    // Calcular la fecha límite (un mes después)
    $endDate = date('Y-m-d', strtotime("$currentDate +1 month"));

    // Ejecutar la consulta
    $consultad = DB::select('SELECT p.nombre, c.nombre as categoria, p.peso, p.unidad, l.fecha_expiracion
                             FROM lotes l
                             JOIN productos p ON l.producto_id = p.id
                             JOIN categorias c ON p.categoria_id = c.id
                             WHERE l.fecha_expiracion BETWEEN :currentDate AND :endDate',
                             ['currentDate' => $currentDate, 'endDate' => $endDate]);

    // Devolver los resultados en formato JSON
    return response()->json($consultad);
}
}
