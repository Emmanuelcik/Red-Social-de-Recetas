<?php

namespace App\Http\Controllers;
use App\Receta;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index() {
        //obtener ls nuevas recetas
        // $nuevas = Receta::orderBy("created_at", "DESC")->get();
        $nuevas = Receta::latest()->take(5)->get();
        return view("inicio.index", compact("nuevas"));
    }
}
