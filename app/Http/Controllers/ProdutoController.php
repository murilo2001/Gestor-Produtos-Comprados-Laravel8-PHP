<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\User;
use App\Models\Categoria;
use Response;
use Carbon\Carbon;
use App\Http\Requests\ProdutoRequest;
use App\Http\Requests\CategoriaRequest;


class ProdutoController extends Controller
{
    public function index()
    {     
        return view('welcome');
    }

    public function create()
    {
        $categorias = Categoria::all();

        return view('produtos.cadastrar',['categorias'=> $categorias]);
    }

    public function store(ProdutoRequest $request)
    {
        /* Resgata a entidade do usuario */
        $user = auth()->user();
        //estabelecimento_compra
        //dd($request->all());

        /* Resgata a requisição e edita alguns parametros */
        $requestData = $request->all();
        $requestData['user_id'] = $user->id;

        if($request->nota_fiscal_image){
            /* Resgata a imagem da request */
            $requestImage = $request->nota_fiscal_image;

            /* Resgata a extensão da imagem */
            $extension = $requestImage->extension();
            
            /* Resgata o nome da imagem concatenado com o tempo now (agora) concatenado com a extensao
            OBS: O md5 gera uma string alfa-numérica de 32 caracteres */
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            /* Move a imagem que foi feito o upload para a pasta img/nota_fiscal_img_upload_user */
            $requestImage->move(public_path('img/nota_fiscal_img_upload_user'), $imageName);

            $requestData['nota_fiscal_image'] = $imageName;
        }
        //dd($requestData);
        Produto::create($requestData);

        return redirect('/')->with('msg','Produto cadastrado com sucesso');
    }

    public function edit($id)
    {
        /* O metodo estatico findOrFail ou firstOrFail recupera o primeiro resultado da consulta, porem caso
        não retornar nada dispara uma Exception = Illuminate\Database\Eloquent\ModelNotFoundException */
        $produto = Produto::findOrFail($id);

        $categorias = Categoria::all();

        return view('produtos.edit',['produto' => $produto, 'categorias' => $categorias]);
    }

    public function update(ProdutoRequest $request)
    {
        $entidade = $request->all();
 
        if($request->nota_fiscal_image){
            /* Image Upload*/
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
    
    public function show($id)
    {
        /* O metodo estatico findOrFail ou firstOrFail recupera o primeiro resultado da consulta, porem caso
        não retornar nada dispara uma Exception = Illuminate\Database\Eloquent\ModelNotFoundException */
        $produto = Produto::findOrFail($id);

        $tempoRestante;

        /* Verifica a data que foi realizado a aquisição do produto e soma a quantidade de tempo de gerantia */
        $dataCompra = $produto->data_compra;

        /* Converte a data de expiração da garantia em segundos */
        $dataExpiracaoGarantia = strtotime($dataCompra . "+{$produto->tempo_garantia_meses} months");

        /* Converte a data/hora atual em segundos */
        $dataAtual = strtotime("now");

        /* Verifica se a garantia ainda não venceu */
        if($dataExpiracaoGarantia > $dataAtual){
            
            /* Calcula a diferença em segundos entre as datas */
            $diferenca = $dataExpiracaoGarantia - $dataAtual;
            /* Calcula a diferença em dias */
            $dias = $diferenca / (60 * 60 * 24);
            /* ceil = arredonda o numero caso esteja quebrado */
            $dias = ceil($dias);
            
            $tempoRestante = "prazo restante: {$dias} dia(s)";
        }else{
            $tempoRestante = 'garantia vencida'; 
        }
        
        return view('produtos.show', ['produto' => $produto,'tempoRestante' => $tempoRestante]);
    }

    public function download_nota_fiscal_image($id){
        $produto = Produto::findOrFail($id);
        if($produto->nota_fiscal_image){
            $filepath = public_path('img/nota_fiscal_img_upload_user/'.$produto->nota_fiscal_image);
            return Response::download($filepath);
        }else{
            return view('produtos.show', ['produto' => $produto]);
        }
    }

    public function dashboard()
    {
        /* Resgata a entidade do usuario atenticado */
        $user = auth()->user();

        /* Resgata todos produtos do usuario */
        $produtos = $user->produtos;

        $categorias = Categoria::all();

        /* Retorna todos os produtos para a view dashboard */
        return view('dashboard', ['produtos' => $produtos, 'categorias' => $categorias]);
    }

    public function destroy($id)
    {
        /* O metodo estatico findOrFail ou firstOrFail recupera o primeiro resultado da consulta, porem caso
        não retornar nada dispara uma Exception = Illuminate\Database\Eloquent\ModelNotFoundException,
        o ->delete() apaga esse registro do banco caso encontrar */
        $produto = Produto::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Produto excluido com sucesso');
    }
}
