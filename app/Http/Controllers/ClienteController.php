<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(cliente::get());
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
        $clienteexistente = cliente::where('ci', $request->ci)->first();

        if ($clienteexistente) {
            return response()->json(['error' => 'El cliente ya está registrado.'], 400);
        }

        $cliente = cliente::create($request->all());
        $cliente2 = cliente::get(); //esto devuelve a la vista todos los registros creados contando el que se creeo recientemente
        return response()->json($cliente2);
    }

    /**
     * Display the specified resource.
     */
    public function show(cliente $id)
    {
        $cliente = cliente::find($id);
        if ($cliente) {
            return response()->json($cliente);
        } else {
            return response()->json('Usuario no Encontrado', 409);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        // Verificar si ya existe un producto con el mismo código
        $clienteexistente = cliente::where('ci', $request->ci)->first();

        if ($clienteexistente) {
            return response()->json(['error' => 'El cliente ya está registrado.'], 400);
        }
        $cliente = cliente::find($id);
        if ($cliente) {
            $cliente = $cliente->update($request->all());
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente = cliente::find($id);
        if (!$cliente) {
            return response()->json('usuario no encontrado', 400);
        }
        $cliente->delete();
        return $this->index();
    }

    public function imageUpload(Request $request)
    {
        $imagen = $request->file('image');
        $path_img = 'cliente';
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
        return response()->download(public_path('storage') . '/cliente/' . $nombre, $nombre);
    }
}
