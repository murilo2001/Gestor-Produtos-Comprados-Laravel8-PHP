<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\User;
use App\Models\Categoria;
use Response;

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

    public function store(Request $request)
    {

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

        /* Resgata o ID da categoria selecionada pelo usuario */
        $categoriaId = Categoria::where([
            ['nome', '=', $request->categoria]
        ])->get()[0]->id;
        
        $produto->categoria_id = $categoriaId;

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

    public function edit($id)
    {
        /* O metodo estatico findOrFail ou firstOrFail recupera o primeiro resultado da consulta, porem caso
        não retornar nada dispara uma Exception = Illuminate\Database\Eloquent\ModelNotFoundException */
        $produto = Produto::findOrFail($id);

        $categorias = Categoria::all();

        return view('produtos.edit',['produto' => $produto, 'categorias' => $categorias]);
    }

    public function update(Request $request)
    {
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
    
    public function show($id)
    {
        /* O metodo estatico findOrFail ou firstOrFail recupera o primeiro resultado da consulta, porem caso
        não retornar nada dispara uma Exception = Illuminate\Database\Eloquent\ModelNotFoundException */
        $produto = Produto::findOrFail($id);

        /* Retorna a view produtos.show e envia o produto contido na variavel $produto para lá */
        return view('produtos.show', ['produto' => $produto]);
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

        /* Retorna todos os produtos para a view dashboard */
        return view('dashboard', ['produtos' => $produtos]);
    }

    public function destroy($id)
    {
        /* O metodo estatico findOrFail ou firstOrFail recupera o primeiro resultado da consulta, porem caso
        não retornar nada dispara uma Exception = Illuminate\Database\Eloquent\ModelNotFoundException,
        o ->delete() apaga esse registro do banco caso encontrar */
        $produto = Produto::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Produto excluido com sucesso');
    }

    public function store_categoria(Request $request)
    {
        /* Cria uma nova entidade Produto*/
        $categoria = new Categoria;

        /* Seta os atributos à entidade*/
        $categoria->nome = $request->nome_categoria;
        $categoria->save();
        return redirect('/produtos/cadastrar')->with('msg', 'Categoria criada com sucesso');
    }
}
