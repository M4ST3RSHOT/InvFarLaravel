<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\categoria;
use App\Http\Requests\StorecategoriaRequest;
use App\Http\Requests\UpdatecategoriaRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
    public function store(Request $request)
    {
        $categoria=categoria::create($request->all());
        $cateogira2=categoria::get();//esto devuelve a la vista todos los registros creados contando el que se creeo recientemente
        return response()->json($cateogira2);
    }

    /**
     * Display the specified resource.
     */
    public function show(categoria $id)
    {
        $id=categoria::find($id);
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
    public function update(Request $request,$id)
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
    public function destroy($id)
    {
        $categoria=categoria::find($id);
        if(!$categoria){
            return response()->json('usuario no encontrado',400);
        }
        $categoria->delete();
        return $this->index();
    }

    public function imageUpload(Request $request){
        $imagen=$request->file('image');
        $path_img='categoria';
        $imageName = $path_img.'/'.$imagen->getClientOriginalName();
        try {
            Storage::disk('public')->put($imageName, File::get($imagen));
        }
        catch (\Exception $exception) {
            return response('error',400);
        }
        return response()->json(['image' => $imageName]);
    }
    public function image($nombre){
        return response()->download(public_path('storage').'/categoria/'.$nombre,$nombre);
    }


    public function productos($id){
        $productos=Categoria::Productos($id);
        return response()->json($productos);
    }

}
