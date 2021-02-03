@extends('layouts.main')

@section('title', 'Cadastrar Produto')

@section('content')

<div id="evento-create-container" class="col-md-6 offset-md-3">
    <h1>Cadastre o seu produto</h1>
    <br>
    <form action="/produtos" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <!-- <div class="observacao"> • largura recomendada: <strong>503</strong>, altura recomendada: <strong>335</strong></div> -->
        <div class="observacao"> • dimensoes recomendadas para melhor resolução: <strong>largura: 503 || altura: 335</strong></div>
        <label for="image">Imagem do Produto:</label>
        <input type="file" id="image" name="image" class="from-control-file">
    </div>
        <br>
        <div class="form-group">
            <label for="titulo">Produto:</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Produto">
        </div>
        <br>
        <div class="form-group">
            <label for="titulo">Categoria:</label>
            <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Categoria do Produto">
        </div>
        <br>
        <div class="form-group">
            <label for="titulo">Valor:</label>
            <input type="number" min="0" class="form-control" id="valor" name="valor" placeholder="Valor do Produto">
        </div>
        <br>
        <div class="form-group">
            <label for="date">Data de compra:</label>
            <input type="date" class="form-control" id="data_compra" name="data_compra">
        </div>
        <br>
        <div class="form-group">
            <label for="date">Tempo Garantia (Mêses):</label>
            <input type="number" min="0" class="form-control" id="tempo_garantia_meses" name="tempo_garantia_meses" placeholder="Tempo de garantia do produto">
        </div>
        <br>
        <div class="form-group">
            <label for="titulo">Observação:</label>
            <textarea name="observacao" id="observacao" class="form-control" placeholder="Observações sobre o produto"></textarea>
        </div>
        <br>
        <div class="form-group">
            <label for="titulo">Seu produto possui nota fiscal ?</label>
            <div class="form-group">
                <input type="radio" name="items[]" value="sim" onclick="exibeOutros()"> Sim
            </div>
            <div class="form-group">
                <input type="radio" name="items[]" value="nao"> Não
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Cadastrar Produto">
    </form>
</div>

@endsection