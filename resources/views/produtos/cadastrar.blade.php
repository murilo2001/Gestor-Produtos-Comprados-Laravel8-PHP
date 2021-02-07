@extends('layouts.main')

@section('title', 'Cadastrar Produto')

@section('content')

<div id="produto-create-container" class="col-md-6 offset-md-3">
    <h1>Cadastre o seu produto</h1>
    <br>
    <form action="/produtos" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="image">Imagem da Nota Fiscal do Produto</label>
        <input type="file" id="nota_fiscal_image" name="nota_fiscal_image" class="from-control-file">
        <br>
            {{-- @error = diretiva do blade para identificar erro de validação para determinado campo,
                caso encontrar ira imprimir tudo que estiver dentro do @error --}}
                @error('nota_fiscal_image')
                <span class="validacao-container"><small>{{$message}}</small></span> 
             @enderror
    </div>
        <br>
        <div class="form-group">
            <label for="nome">Produto</label><font color="red">*</font>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Produto">
            {{-- @error = diretiva do blade para identificar erro de validação para determinado campo,
                caso encontrar ira imprimir tudo que estiver dentro do @error --}}
            @error('nome')
               <span class="validacao-container"><small>{{$message}}</small></span> 
            @enderror
        </div>
        <br>
        <div class="form-group">
            <label for="categoria">Categoria</label><font color="red">*</font>
            <div class="btn-group inline">
                <select class="custom-select" id="categoria_id" name="categoria_id">
                    <option value="" disabled selected>Selecione uma categoria</option>
                    @foreach($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"><ion-icon name="add-outline"></ion-icon></button>
            </div>
            {{-- @error = diretiva do blade para identificar erro de validação para determinado campo,
            caso encontrar ira imprimir tudo que estiver dentro do @error --}}
            <br>
            @error('categoria_id')
                <span class="validacao-container"><small>{{$message}}</small></span> 
            @enderror
        </div>
        <br>
        <div class="form-group">
            <label for="valor">Valor</label><font color="red">*</font>
            <input type="number" min="0" class="form-control" id="valor" name="valor" placeholder="Valor do Produto">
            {{-- @error = diretiva do blade para identificar erro de validação para determinado campo,
                caso encontrar ira imprimir tudo que estiver dentro do @error --}}
            @error('valor')
                <span class="validacao-container"><small>{{$message}}</small></span> 
             @enderror
        </div>
        <br>
        <div class="form-group">
            <label for="data_compra">Data de compra</label><font color="red">*</font>
            <input type="date" class="form-control" id="data_compra" name="data_compra">
            {{-- @error = diretiva do blade para identificar erro de validação para determinado campo,
                caso encontrar ira imprimir tudo que estiver dentro do @error --}}
                @error('data_compra')
                <span class="validacao-container"><small>{{$message}}</small></span> 
             @enderror
        </div>
        <br>
        <div class="form-group">
            <label for="tempo_garantia_meses">Tempo Garantia (Mêses)</label><font color="red">*</font>
            <input type="number" min="0" class="form-control" id="tempo_garantia_meses" name="tempo_garantia_meses" placeholder="Tempo de garantia do produto">
            {{-- @error = diretiva do blade para identificar erro de validação para determinado campo,
                caso encontrar ira imprimir tudo que estiver dentro do @error --}}
                @error('tempo_garantia_meses')
                <span class="validacao-container"><small>{{$message}}</small></span> 
             @enderror
        </div>
        <br>
        <div class="form-group">
            <label for="observacao">Observação</label>
            <textarea name="observacao" id="observacao" class="form-control" placeholder="Observações sobre o produto"></textarea>
            {{-- @error = diretiva do blade para identificar erro de validação para determinado campo,
                caso encontrar ira imprimir tudo que estiver dentro do @error --}}
                @error('observacao')
                <span class="validacao-container"><small>{{$message}}</small></span> 
             @enderror
        </div>
        <input type="submit" class="btn btn-primary" value="Cadastrar Produto">
    </form>
</div>

{{-- Inicio Modal Categoria --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Nova Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/categorias" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">

            <div class="form-group">
                <label for="nome">Nome</label><font color="red">*</font>
                <input type="text" class="form-control" id="nome_categoria" name="nome_categoria" placeholder="Nome da Categoria do Produto">
                {{-- @error = diretiva do blade para identificar erro de validação para determinado campo,
                caso encontrar ira imprimir tudo que estiver dentro do @error --}}
                @error('nome_categoria')
                <span class="validacao-container"><small>{{$message}}</small></span> 
             @enderror
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Criar categoria</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- FIM Modal Categoria --}}

@endsection