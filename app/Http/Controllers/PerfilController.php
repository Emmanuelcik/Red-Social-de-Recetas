<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth", ["except" => "show"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        $recetas = Receta::where("user_id", $perfil->user_id)->paginate(9);
        return view("perfiles.show", compact("perfil", "recetas") );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        $this->authorize("view", $perfil);
        
        return view("perfiles.edit", compact("perfil"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        //verificar que el usuario autenticado sea el que quiera actualizar
        $this->authorize("update", $perfil);
        //validar 
        $data = $request->validate([
            "nombre" => "required",
            "url" => "required",
            "biografia" => "required",
        ]);
        //Si el usuario sube una imagen
        if ($request["imagen"]) {
            //Obtener la ruta de la imagen
            $ruta_imagen = $request["imagen"]->store("upload-perfiles", "public");
            //Rezise de la imagen 
            $imagen = Image::make( public_path("storage/{$ruta_imagen}") )->fit(400, 400);
            $imagen->save();

            //Crear un arreglo de la imagen
            $array_imagen = ["imagen" => $ruta_imagen];
        }
        //Asignar nombre y url
        auth()->user()->url = $data["url"];
        auth()->user()->name = $data["nombre"];
        auth()->user()->save();
        //eliinar name y url de data 
        unset($data["url"]);
        unset($data["nombre"]);
        //Asignar biografia e imagen 
        auth()->user()->perfil()->update( array_merge(
            $data, 
            $array_imagen ?? []
        ));
        //Guardar informacion

        //redireccionar
        return redirect()->action("PerfilController@show", ["perfil" => $perfil->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
