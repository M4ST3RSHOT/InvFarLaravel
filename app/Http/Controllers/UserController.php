<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(user::get());
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
        $userexistente = User::where('ci', $request->ci)->first();

        if ($userexistente) {
            return response()->json(['error' => 'El usuario ya está registrado.'], 400);
        }
        $request['password'] = Hash::make($request['password']);

        $user = user::create($request->all()); //esto devuelve a la vista el registro que se esta creando en store

        $personal2 = user::get(); //esto devuelve a la vista todos los registros creados contando el que se creeo recientemente

        return response()->json($personal2);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = user::find($id);
        if ($user) {
            return response()->json($user);
        } else {
            return response()->json('Usuario no Encontrado', 409);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        // Verificar si ya existe un producto con el mismo código
        $userexistente = User::where('ci', $request->ci)->first();

        if ($userexistente) {
            return response()->json(['error' => 'El usuario ya está registrado.'], 400);
        }
        $user = user::find($id);
        if ($user) {
            $user = $user->update($request->all());
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = user::find($id);
        if (!$user) {
            return response()->json('usuario no encontrado', 409);
        }
        $user->delete();
        return $this->index();
    }

    // public function imageUpload(Request $request){
    //     $imagen=$request->file('image');
    //     $path_img='user';
    //     $imageName = $path_img.'/'.$imagen->getClientOriginalName();
    //     try {
    //         Storage::disk('public')->put($imageName, File::get($imagen));
    //     }
    //     catch (\Exception $exception) {
    //         return response('error',400);
    //     }
    //     return response()->json(['image' => $imageName]);
    // }

    public function imageUpload(Request $request)
    {
        // Obtener la imagen del request
        $imagen = $request->file('image');

        // Ruta donde se almacenará la imagen en la carpeta 'public'
        $path_img = 'user'; // Puedes cambiar esto según tus necesidades

        // Nombre de la imagen (se usará el nombre original del archivo)
        $imageName = $imagen->getClientOriginalName();

        try {
            // Almacenar la imagen en la carpeta 'public'
            $imagen->storeAs($path_img, $imageName, 'public');
        } catch (\Exception $exception) {
            // Manejar cualquier error que ocurra durante el almacenamiento
            return response('error', 400);
        }

        // Devolver la ruta completa de la imagen almacenada
        return response()->json(['image' => asset('storage/' . $path_img . '/' . $imageName)]);
    }
    public function image($nombre)
    {

        // return response()->download('C:\xampp\htdocs\proyecto farmacia 0.1\Laravel\storage\app\public/personal/'.$nombre,$nombre);
        return response()->download(public_path('storage') . '/user/' . $nombre, $nombre);
    }

    public function listar_nombres()
    {
        $consulta = DB::select('SELECT p.* FROM personals p');
        return response()->json($consulta);
    }

}
