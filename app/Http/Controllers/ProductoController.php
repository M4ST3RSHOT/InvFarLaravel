<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\producto;
use App\Http\Requests\StoreproductoRequest;
use App\Http\Requests\UpdateproductoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(producto::get());
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
    public function store(StorepersonalRequest $request)
    {
        $request['password']=Hash::make($request['password']);
        $producto=producto::create($request->all());
        return response()->json($producto);
    }

    /**
     * Display the specified resource.
     */
    public function show(producto $producto)
    {
        $producto=producto::find($id);
        if($producto)
            return response()->json($producto);
        else
        return response()->json('Usuario no Encontrado',409);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepersonalRequest $request, producto $producto)
    {
        $producto=producto::find($id);
        if($producto){
            $producto=$producto->update($request->all());
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(producto $producto)
    {
        $producto=producto::find($id);
        if(!$producto){
            return response()->json('usuario no encontrado',400);
        }
        $producto->delete();
        return $this->index();
    }

    public function imageUpload(Request $request){
        $imagen=$request->file('image');
        $path_img='producto';
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
        return response()->download(public_path('storage').'/producto/'.$nombre,$nombre);
    }
}
