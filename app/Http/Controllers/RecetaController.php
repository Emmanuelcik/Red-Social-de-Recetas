<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth", ["except" => "show"]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // auth()->user()->recetas->dd();
        // $recetas = auth()->user()->recetas;
        $usuario = auth()->user();
        $recetas = Receta::where("user_id", $usuario->id)->paginate(2);
        return view('recetas.index')
                ->with("recetas", $recetas)
                ->with("usuario", $usuario);
                // ->with("usuario", $usuario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Obtener las categorias sin un modelo
        //$categorias = DB::table('categoria_recetas')->get()->pluck("nombre", "id");

        //obtener las categorias pero con un modelo
        $categorias = CategoriaReceta::all(["id", "nombre"]);

        return view("recetas.create")->with("categorias", $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd( $request["imagen"]->store("upload-recetas", "public") );
        //Validacion
        $data = request()->validate([
            "titulo" => "required|min:6",
            "categoria" => "required",
            "preparacion" => "required",
            "ingredientes" => "required",
             "imagen" => "required|image"
        ]);
        
        //Obtener la ruta de la imagen
        $ruta_imagen = $request["imagen"]->store("upload-recetas", "public");
        //Rezise de la imagen 
        $imagen = Image::make( public_path("storage/{$ruta_imagen}") )->fit(1000, 550);
        $imagen->save();

        //almacenar en la bd sin modelo
        // DB::table("recetas")->insert([
        //     "titulo" => $data["titulo"],
        //     "preparacion" => $data["preparacion"],
        //     "ingredientes" => $data["ingredientes"],
        //     "imagen" => $ruta_imagen,
        //     "user_id" => Auth::user()->id,
        //     "categoria_id" => $data["categoria"]
        // ]);

        //Almacenar en la base de datos con el modelo
        Auth::user()->recetas()->create([
            "titulo" => $data["titulo"],
            "preparacion" => $data["preparacion"],
            "ingredientes" => $data["ingredientes"],
            "imagen" => $ruta_imagen,
            "categoria_id" => $data["categoria"]
        ]);
        return redirect()->action("RecetaController@index");
    }
        
    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        
        //Obtener si el usuario actual le gusta la receta y esta autenticado
        $like = ( auth()->user() ) ?  auth()->user()->meGusta->contains($receta->id) : false;
        $likes = $receta->likes->count();
        return view("recetas.show")->with("receta", $receta)->with("like",$like)->with("likes",$likes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        $this->authorize("view", $receta);
        $categorias = CategoriaReceta::all(["id", "nombre"]);
        return view("recetas.edit", compact("categorias", "receta"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {

        //Revisar el policy 
        $this->authorize("update", $receta);

        $data = $request->validate([
            "titulo" => "required|min:6",
            "categoria" => "required",
            "preparacion" => "required",
            "ingredientes" => "required",
            // "imagen" => "required|image"
        ]);

        //Si el usuario sube una nueva imagen 
        if(request("imagen")){
            //Obtener la ruta de la imagen
            $ruta_imagen = $request["imagen"]->store("upload-recetas", "public");
            //Rezise de la imagen 
            $imagen = Image::make( public_path("storage/{$ruta_imagen}") )->fit(1000, 550);
            $imagen->save();
            $receta->imagen = $ruta_imagen;
        }

        $receta->titulo = $data["titulo"];
        $receta->preparacion = $data["preparacion"];
        $receta->categoria_id = $data["categoria"];
        $receta->ingredientes = $data["ingredientes"];
        $receta->save();

        
        //redireccionar
        return redirect()->action("RecetaController@index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //Ejecutar el policy 
        $this->authorize("delete", $receta);

        //Eliminar la receta
        $receta->delete();

        return redirect()->action("RecetaController@index");
    }
}
