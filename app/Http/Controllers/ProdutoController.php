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

    public function create(){
        return view('produtos.cadastrar');
    }

    public function store(Request $request){

        /* Cria uma nova entidade Produto*/
        $produto = new Produto;

        /* Resgata a entidade do usuario */
        $user = auth()->user();

        /* Seta os atributos à entidade*/
        $produto->nome = $request->nome;
        $produto->categoria = $request->categoria;
        $produto->valor = $request->valor;
        $produto->data_compra = $request->data_compra;
        $produto->tempo_garantia_meses = $request->tempo_garantia_meses;
        $produto->observacao = $request->observacao;
        $produto->user_id = $user->id;

        /* Image Upload*/
        /* Verifica se possui alguma imagem no request e se ela é valida */
        if($request->hasFile('nota_fiscal_image') && $request->file('nota_fiscal_image')->isValid()){
            
            /* Resgata a imagem da request */
            $requestImage = $request->nota_fiscal_image;
            /* Resgata a extensão da imagem */
            $extension = $requestImage->extension();
            /* Resgata o nome da imagem concatenado com o tempo now (agora) concatenado com a extensao
            OBS: O md5 gera uma string alfa-numérica de 32 caracteres */
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            
            /* Move a imagem que foi feito o upload para a pasta img/nota_fiscal_img_upload_user */
            $requestImage->move(public_path('img/nota_fiscal_img_upload_user'), $imageName);

            $produto->nota_fiscal_image = $imageName;
        }

        $produto->save();

        return redirect('/')->with('msg','Produto cadastrado com sucesso');
    }

    public function edit($id){
        /* O metodo estatico findOrFail ou firstOrFail recupera o primeiro resultado da consulta, porem caso
        não retornar nada dispara uma Exception = Illuminate\Database\Eloquent\ModelNotFoundException */
        $produto = Produto::findOrFail($id);
        return view('produtos.edit',['produto' => $produto]);
    }

    public function update(Request $request){

        $entidade = $request->all();

        /* Image Upload*/
        /* Verifica se possui alguma imagem no request e se ela é valida */
        if($request->hasFile('nota_fiscal_image') && $request->file('nota_fiscal_image')->isValid()){
            /* Resgata a imagem da request */
            $requestImage = $request->nota_fiscal_image;
            /* Resgata a extensão da imagem */
            $extension = $requestImage->extension();
            /* Resgata o nome da imagem concatenado com o tempo now (agora) concatenado com a extensao
            OBS: O md5 gera uma string alfa-numérica de 32 caracteres */
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            
            /* Move a imagem que foi feito o upload para a pasta img/nota_fiscal_img_upload_user */
            $requestImage->move(public_path('img/nota_fiscal_img_upload_user'), $imageName);
            
            $entidade['nota_fiscal_image'] = $imageName;
        }

        $produto = Produto::findOrFail($request->id)->update($entidade);
        
        return redirect('/dashboard')->with('msg', 'Produto editado com sucesso');
    }
    
    public function show($id){

        /* O metodo estatico findOrFail ou firstOrFail recupera o primeiro resultado da consulta, porem caso
        não retornar nada dispara uma Exception = Illuminate\Database\Eloquent\ModelNotFoundException */
        $produto = Produto::findOrFail($id);

        /* Irá retornar a entidade do usuario cujo id foi resgatado na função */
        $donoEvento = User::where('id', '=', $produto->user_id)->first()->toArray();

        /* Retorna a view eventos.show e envia o evento contido na variavel $evento para lá */
        return view('produtos.show', ['produto' => $produto, 'donoEvento' => $donoEvento]);
    }

    public function download_nota_fiscal_image($id){
        echo 'teste';
    }
}
