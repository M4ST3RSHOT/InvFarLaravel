<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\adquiere;
use App\Http\Requests\StoreadquiereRequest;
use App\Http\Requests\UpdateadquiereRequest;
use Illuminate\Support\Facades\DB;

class AdquiereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consulta=DB::select('SELECT a.id as idadquiere,u.nombre as nombreuser,p.nombre as nombreproveedor,a.fecha,a.montototal  FROM users u, adquieres a, proveedors p WHERE u.id=a.user_id and a.proveedor_id=p.id') ;
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
        $adquiere=adquiere::create($request->all());
        $adquiere2=adquiere::get();//esto devuelve a la vista todos los registros creados contando el que se creeo recientemente
        return response()->json(['id' => $adquiere->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $adquiere=adquiere::find($id);
        if($adquiere)
            return response()->json($adquiere);
        else
        return response()->json('Usuario no Encontrado',409);
    }

    public function detallar($id)
    {   
        
        $consultaa=DB::select('SELECT a.*
                            FROM adquieres a
                            WHERE a.id=:id',['id'=> $id]);
        $consultal=DB::select('SELECT l.stock as cantidad ,p.*
        FROM lotes l, adquieres a, productos p
        WHERE a.id=l.adquiere_id and p.id=l.producto_id and a.id=:id',['id'=> $id]);
                            
        $consultap=DB::select('SELECT p.nombre,p.telefono, p.direccion,p.cinit 
        FROM adquieres a, proveedors p
        WHERE p.id=a.proveedor_id and a.id=:id GROUP BY p.nombre,p.telefono, p.direccion,p.cinit ',['id'=> $id]);

        $consultau=DB::select('SELECT u.nombre
        FROM adquieres a,users u
        WHERE u.id=a.user_id and a.id=:id',['id'=> $id]);
        
        
        return response()->json([$consultaa,[$consultal],$consultap,$consultau]);
        // return response()->json($consultal);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $adquiere=adquiere::find($id);
        if($adquiere){
            $adquiere=$adquiere->update($request->all());
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $adquiere=adquiere::find($id);
        if(!$adquiere){
            return response()->json('usuario no encontrado',400);
        }
        $adquiere->delete();
        return $this->index();
    }
}
