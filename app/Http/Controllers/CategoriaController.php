<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        // Verificar si ya existe un producto con el mismo código
        $categoriaexistente = categoria::where('nombre', $request->nombre)->first();

        if ($categoriaexistente) {
            return response()->json(['error' => 'La categoria ya está registrado.'], 400);
        }

        $categoria = categoria::create($request->all());
        $cateogira2 = categoria::get(); //esto devuelve a la vista todos los registros creados contando el que se creeo recientemente
        return response()->json($cateogira2);
    }

    /**
     * Display the specified resource.
     */
    public function show(categoria $id)
    {
        $id = categoria::find($id);
        if ($categoria) {
            return response()->json($categoria);
        } else {
            return response()->json('Usuario no Encontrado', 409);
        }

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
    public function update(Request $request, $id)
    {

        // Verificar si ya existe un producto con el mismo código
        $categoriaexistente = categoria::where('nombre', $request->nombre)->first();

        if ($categoriaexistente) {
            return response()->json(['error' => 'La categoria ya está registrado.'], 400);
        }
        $categoria = categoria::find($id);
        if ($categoria) {
            $categoria = $categoria->update($request->all());
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoria = categoria::find($id);
        if (!$categoria) {
            return response()->json('usuario no encontrado', 400);
        }
        $categoria->delete();
        return $this->index();
    }

    public function imageUpload(Request $request)
    {
        $imagen = $request->file('image');
        $path_img = 'categoria';
        $imageName = $path_img . '/' . $imagen->getClientOriginalName();
        try {
            Storage::disk('public')->put($imageName, File::get($imagen));
        } catch (\Exception $exception) {
            return response('error', 400);
        }
        return response()->json(['image' => $imageName]);
    }
    public function image($nombre)
    {
        return response()->download(public_path('storage') . '/categoria/' . $nombre, $nombre);
    }

    public function productos($id)
    {
        $productos = Categoria::Productos($id);
        return response()->json($productos);
    }

}
