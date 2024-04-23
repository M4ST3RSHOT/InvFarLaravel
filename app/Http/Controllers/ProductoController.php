<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\producto;
use App\Http\Requests\StoreproductoRequest;
use App\Http\Requests\UpdateproductoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

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
    public function store(Request $request)
    {
        $producto=producto::create($request->all());
        $producto2=producto::get();//esto devuelve a la vista todos los registros creados contando el que se creeo recientemente

        return response()->json($producto2);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
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
    public function update(Request $request, $id)
    {
        $producto=producto::find($id);
        if($producto){
            $producto=$producto->update($request->all());
        }
        return response()->json($producto);
    }

    public function updatestock(Request $request, $id)
    {
        $producto=producto::find($id);
        if ($producto) {
            // Obtener el stock enviado en la solicitud
            $nuevoStock = $request->input('stock');
    
            // Calcular el stock actualizado restando el stock enviado del stock actual del producto
            $stockActualizado = $producto->stock - $nuevoStock;
    
            // Actualizar el stock del producto
            $producto->stock = $stockActualizado;
            $producto->save();
        }
        return $this->index();
    }

    public function updatestockplus(Request $request, $id)
    {
        $producto=producto::find($id);
        if ($producto) {
            // Obtener el stock enviado en la solicitud
            $nuevoStock = $request->input('stock');
    
            // Calcular el stock actualizado restando el stock enviado del stock actual del producto
            $stockActualizado = $producto->stock + $nuevoStock;
    
            // Actualizar el stock del producto
            $producto->stock = $stockActualizado;
            $producto->save();
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
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

    public function listar_nombres(){
        $consulta = Producto::select('productos.nombre')->get();
        return response()->json($consulta);
    }
}
