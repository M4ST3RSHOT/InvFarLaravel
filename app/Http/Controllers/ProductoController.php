<?php

namespace App\Http\Controllers;

use App\Models\producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultad = DB::select('SELECT p.id,p.codigo,p.nombre,p.descripcion,p.unidad,p.peso,c.nombre as categoria,p.precio_compra,p.precio_venta,p.imagen,p.stock
        FROM productos p, categorias c
        WHERE p.categoria_id=c.id');

        return response()->json($consultad);
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
    // public function store(Request $request)
    // {
    //     $producto = producto::create($request->all());
    //     $producto2 = producto::get();

    //     return response()->json($producto2);
    // }

    public function store(Request $request)
    {
        // Verificar si ya existe un producto con el mismo código
        $productoExistente = producto::where('codigo', $request->codigo)->first();

        if ($productoExistente) {
            return response()->json(['error' => 'El código ya está registrado.'], 400);
        }

        // Crear el producto ya que el código no está duplicado
        $producto = producto::create($request->all());

        // Obtener todos los productos
        $producto2 = producto::get();

        return response()->json($producto2);
    }

    // public function storeMultiple(Request $request)
    // {
    //     // Validar que se reciba un array de productos
    //     $productosData = $request->all();

    //     // Verificar que sea un array
    //     if (!is_array($productosData)) {
    //         return response()->json(['error' => 'Los datos proporcionados no son válidos.'], 400);
    //     }

    //     // Crear una colección de productos insertados para devolver como respuesta
    //     $productosGuardados = [];

    //     foreach ($productosData as $productoData) {
    //         $producto = producto::create($productoData);
    //         $productosGuardados[] = $producto;
    //     }

    //     return response()->json($productosGuardados);
    // }

    public function storeMultiple(Request $request)
    {
        // Validar que se reciba un array de productos
        $productosData = $request->all();

        // Verificar que sea un array
        if (!is_array($productosData)) {
            return response()->json(['error' => 'Los datos proporcionados no son válidos.'], 400);
        }

        // Crear una colección de productos insertados para devolver como respuesta
        $productosGuardados = [];
        $errores = [];

        foreach ($productosData as $productoData) {
            // Verificar si ya existe un producto con el mismo código
            $productoExistente = producto::where('codigo', $productoData['codigo'])->first();

            if ($productoExistente) {
                $errores[] = [
                    'codigo' => $productoData['codigo'],
                    'mensaje' => 'El código ya está registrado.',
                ];
                continue; // Saltar a la siguiente iteración
            }

            // Crear el nuevo producto
            $producto = producto::create($productoData);
            $productosGuardados[] = $producto;
        }

        // Devolver los productos guardados y los errores encontrados
        return response()->json([
            'productosGuardados' => $productosGuardados,
            'errores' => $errores,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = producto::find($id);
        if ($producto) {
            return response()->json($producto);
        } else {
            return response()->json('Producto no Encontrado', 409);
        }

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
        // Verificar si ya existe un producto con el mismo código
        $productoExistente = producto::where('codigo', $request->codigo)->first();

        if ($productoExistente) {
            return response()->json(['error' => 'El código ya está registrado.'], 400);
        }

        $producto = producto::find($id);
        if ($producto) {
            $producto = $producto->update($request->all());
        }
        return response()->json($producto);
    }

    public function updatestock(Request $request, $id)
    {
        $producto = producto::find($id);
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
        $producto = producto::find($id);
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
    public function destroy($id)
    {
        $producto = producto::find($id);
        if (!$producto) {
            return response()->json('usuario no encontrado', 400);
        }
        $producto->delete();
        return $this->index();
    }

    public function imageUpload(Request $request)
    {
        $imagen = $request->file('image');
        $path_img = 'producto';
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
        return response()->download(public_path('storage') . '/producto/' . $nombre, $nombre);
    }

    public function listar_nombres()
    {
        $consulta = Producto::select('productos.nombre')->get();
        return response()->json($consulta);
    }

    // public function listarproductoscategoria($id) //pareciese que tenemos esto repetido pero en el controlador de categoria
    // {

    //     $consultad=DB::select('SELECT p.*
    //     FROM productos p, categorias c
    //     WHERE p.categoria_id=c.id and c.id=:id',['id' => $id]);

    //     return response()->json($consultad);
    // }

    public function reporte($dia1, $mes1, $gestion1, $dia2, $mes2, $gestion2) //devuelve la lista de productos con sus respectivas fechas de expiracvion
    {
        // Convertir día, mes y año en una fecha
        $currentDate = "$gestion1-$mes1-$dia1";

        // Calcular la fecha límite (un mes después)
        $endDate = "$gestion2-$mes2-$dia2";

        // Ejecutar la consulta
        $consultad = DB::select('SELECT p.codigo,p.nombre,p.descripcion,p.unidad,p.peso,c.nombre as categoria,p.precio_compra,p.precio_venta,p.stock,l.fecha_expiracion,l.stock as porcaducar
                                 FROM lotes l
                                 JOIN productos p ON l.producto_id = p.id
                                 JOIN categorias c ON p.categoria_id = c.id
                                 WHERE l.fecha_expiracion BETWEEN :currentDate AND :endDate',
            ['currentDate' => $currentDate, 'endDate' => $endDate]);

        // Devolver los resultados en formato JSON
        return response()->json($consultad);
    }

    public function reporteinventariogeneral($dia1, $mes1, $gestion1, $dia2, $mes2, $gestion2)
    {
        // Convertir día, mes y año en una fecha
        $currentDate = "$gestion1-$mes1-$dia1";
        $endDate = "$gestion2-$mes2-$dia2";

        // Ejecutar la consulta para obtener productos cuya fecha de expiración está entre las dos fechas
        $consultad = DB::select('SELECT p.codigo, p.nombre, p.descripcion, p.unidad, p.peso, c.nombre as categoria,
                                     p.precio_compra, p.precio_venta, p.stock, l.fecha_expiracion, l.stock as porcaducar
                              FROM lotes l
                              JOIN productos p ON l.producto_id = p.id
                              JOIN categorias c ON p.categoria_id = c.id
                              WHERE l.fecha_expiracion BETWEEN :currentDate AND :endDate',
            ['currentDate' => $currentDate, 'endDate' => $endDate]);

        // Ejecutar la consulta para obtener todos los productos

        $todosProductos = DB::select('SELECT p.id,p.codigo,p.nombre,p.descripcion,p.unidad,p.peso,c.nombre as categoria,p.precio_compra,p.precio_venta,p.imagen,p.stock
        FROM productos p, categorias c
        WHERE p.categoria_id=c.id');

        // Crear una respuesta combinada
        $respuesta = [
            'productos_entre_fechas' => $consultad,
            'todos_los_productos' => $todosProductos,
        ];

        // Devolver los resultados en formato JSON
        return response()->json($respuesta);
    }

}
