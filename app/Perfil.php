<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    //Relacion uno a uno de perfil con usuario
    public function usuario () {
        return $this->belongsTo(User::class);
    }
}
