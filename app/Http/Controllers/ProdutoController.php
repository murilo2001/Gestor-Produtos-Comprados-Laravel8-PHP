<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\User;

class ProdutoController extends Controller
{
    public function index(){

        $search = request('search');

        if($search){
            $produtos = Produto::where([
                ['nome', 'like', '%'.$search.'%']
            ])->get();
        }else{
            $produtos = Produto::all();
        }
        
        return view('welcome',['produtos' => $produtos, 'search' => $search]);
    }

    public function store(){
        /* Cria uma nova entidade Produto*/
        $produto = new Produto;
    }

    public function create(){
        return view('produtos.cadastrar');
    }
}
