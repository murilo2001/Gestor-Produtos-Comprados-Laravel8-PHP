@extends('layouts.main')

@section('title', 'Cadastrar Produto')

@section('content')

<div id="produto-create-container" class="col-md-6 offset-md-3">
    <h1>Cadastre o seu produto</h1>
    <br>
    <form action="/produtos" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="image">Imagem da Nota Fiscal do Produto:</label>
        <input type="file" id="nota_fiscal_image" name="nota_fiscal_image" class="from-control-file">
    </div>
        <br>
        <div class="form-group">
            <label for="nome">Produto:</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Produto">
        </div>
        <br>
        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Categoria do Produto">
        </div>
        <br>
        <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="number" min="0" class="form-control" id="valor" name="valor" placeholder="Valor do Produto">
        </div>
        <br>
        <div class="form-group">
            <label for="data_compra">Data de compra:</label>
            <input type="date" class="form-control" id="data_compra" name="data_compra">
        </div>
        <br>
        <div class="form-group">
            <label for="tempo_garantia_meses">Tempo Garantia (Mêses):</label>
            <input type="number" min="0" class="form-control" id="tempo_garantia_meses" name="tempo_garantia_meses" placeholder="Tempo de garantia do produto">
        </div>
        <br>
        <div class="form-group">
            <label for="observacao">Observação:</label>
            <textarea name="observacao" id="observacao" class="form-control" placeholder="Observações sobre o produto"></textarea>
        </div>
        <input type="submit" class="btn btn-primary" value="Cadastrar Produto">
    </form>
</div>

@endsection