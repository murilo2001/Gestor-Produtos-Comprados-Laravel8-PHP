<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    /* A dfinição da variavel guarded vazia informa ao laravel que tudo que for enviado via POST ou PUT
    pode ser atualizado = não tem nenhuma restrição , poderia também ser colocado um campo 
    especifico */
    protected $guarded = [];

    /* Atribuição em Massa */
    protected $fillable = [
        'nome',
        'nota_fiscal_image',
        'valor',
        'estabelecimento_compra',
        'data_compra',
        'tempo_garantia_meses',
        'observacao',
        'categoria_id',
        'user_id'
    ];

    protected $casts = [
        /* Quando for retornado uma 'data_compra' será interpretado no formato date e não string */
        'data_compra' => 'date'
    ];

    /* Function para criação de relação entre produto e usuario */
    public function user(){
        /* belongsTo =  um produto pertence a um usuario, retorna apenas o produto pertecenten ao dono */
        return $this->belongsTo('App\Models\User');
    }

    public function categoria(){
        /* belongsTo =  um produto pertence a uma categoria, retorna apenas o produto pertecenten a categoria */
        return $this->belongsTo('App\Models\Categoria');
        //return $this->hasOne('App\Models\Categoria');
    }
}
