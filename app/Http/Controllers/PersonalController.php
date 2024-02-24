<?php

namespace App\Http\Controllers;
//el problemita con la funcion imagenupload es de usar esta libreria
use Illuminate\Http\Request;

use App\Models\personal;
use App\Http\Requests\StorepersonalRequest;
use App\Http\Requests\UpdatepersonalRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(personal::get());
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
        $request['password']=Hash::make($request['password']);

        $personal=personal::create($request->all());//esto devuelve a la vista el registro que se esta creando en store

        $personal2=personal::get();//esto devuelve a la vista todos los registros creados contando el que se creeo recientemente

        return response()->json($personal2);
    }

    /**
     * Display the specified resource.
     */
    public function show(personal $id)
    {
        $personal=personal::find($id);
        if($personal)
            return response()->json($personal);
        else
        return response()->json('Usuario no Encontrado',409);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(personal $personal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $personal=personal::find($id);
        if($personal){
            $personal=$personal->update($request->all());
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $personal=personal::find($id);
        if(!$personal){
            return response()->json('usuario no encontrado',409);
        }
        $personal->delete();
        return $this->index();
    }





    public function imageUpload(Request $request){
        $imagen=$request->file('image');
        $path_img='personal';
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
        return response()->download(public_path('storage').'/personal/'.$nombre,$nombre);
    }





}
