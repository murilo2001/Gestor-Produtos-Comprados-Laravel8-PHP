<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    /* Function para criação de relação entre categoria e produto */
    public function produtos(){
        /* hasMany =  uma categoria pode ter muitos produtos  */
        return $this->hasMany('App\Models\Produto');
    }
}
