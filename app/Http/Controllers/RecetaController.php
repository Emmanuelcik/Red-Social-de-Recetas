<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // auth()->user()->recetas->dd();
        $recetas = auth()->user()->recetas;
        return view('recetas.index')->with("recetas", $recetas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // DB::table('categoria_receta')->get()->pluck("nombre", "id")->dd();

        //Obtener las categorias sin un modelo
        // $categorias = DB::table('categoria_recetas')->get()->pluck("nombre", "id");

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
        auth()->user()->recetas()->create([
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
        
        return view("recetas.show")->with("receta", $receta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //
    }
}
