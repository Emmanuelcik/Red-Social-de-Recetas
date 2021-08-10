<?php

namespace App\Http\Controllers;

use App\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        return view("perfiles.show", compact("perfil") );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
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
        //validar 
        $data = $request->validate([
            "nombre" => "required",
            "url" => "required",
            "biografia" => "required",
        ]);
        //Si el usuario sube una imagen
        
        //Asignar nombre y url
        auth()->user()->url = $data["url"];
        auth()->user()->name = $data["nombre"];
        auth()->user()->save();
        //eliinar name y url de data 
        unset($data["url"]);
        unset($data["nombre"]);
        //Asignar biografia e imagen 
        auth()->user()->perfil()->update(
            $data
        );
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
