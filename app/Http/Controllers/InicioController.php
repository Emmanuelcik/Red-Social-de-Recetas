<?php

namespace App\Http\Controllers;
use App\Receta;
use Illuminate\Support\Str;
use App\CategoriaReceta;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index() {
        //obtener ls nuevas recetas
        // $nuevas = Receta::orderBy("created_at", "DESC")->get();
        $nuevas = Receta::latest()->take(5)->get();
        //Obtener las categorias

        // $mexicana = Receta::where("categoria_id", 1)->get();
        // return $mexicana;
        $categorias = CategoriaReceta::all();

        //Agrupar las recetas por categoria
        $recetas = [];
        foreach ($categorias as $categoria) {
            $recetas[ Str::slug( $categoria->nombre )][]  = Receta::where("categoria_id", $categoria->id)->take(3)->get() ;
        }
        return $recetas;
        return view("inicio.index", compact("nuevas", "recetas"));
    }
}
