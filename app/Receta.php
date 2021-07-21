<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $fillable = [
        'titulo', 'preparacion', 'ingredientes', 'imagen', 'categoria_id'
    ];
    //Obtiene la categoria de la receta por medio de la llave foranea
    public function Categoria(){
        return $this->belongsTo(CategoriaReceta::class);
    }

    //obtiene la info del usuario via FK
    public function autor(){
        return $this->belongsTo(User::class, "user_id");
    }
}
