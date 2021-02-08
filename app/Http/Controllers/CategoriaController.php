<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categoria;
use App\Http\Requests\CategoriaRequest;

class CategoriaController extends Controller
{
    public function store(CategoriaRequest $request)
    {
        /* Cria uma nova entidade Produto*/
        $categoria = new Categoria;

        /* Seta os atributos à entidade*/
        $categoria->nome = $request->nome_categoria;

        $categoria->save();

        return redirect('/produtos/cadastrar')->with('msg', 'Categoria criada com sucesso');
    }

    public function destroy($id)
    {
        /* O metodo estatico findOrFail ou firstOrFail recupera o primeiro resultado da consulta, porem caso
        não retornar nada dispara uma Exception = Illuminate\Database\Eloquent\ModelNotFoundException,
        o ->delete() apaga esse registro do banco caso encontrar */
        $categoria = Categoria::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Categoria excluida com sucesso');
    }
}
