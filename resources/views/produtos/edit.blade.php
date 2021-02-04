@extends('layouts.main')

@section('title', 'Editando Produto: '. $produto->nome)

@section('content')

<div id="evento-create-container" class="col-md-6 offset-md-3">
    <h1>Editando: {{ $produto->nome }}</h1>
    <br>
    <form action="/produtos/update/{{ $produto->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="image">Imagem da Nota Fiscal do Produto:</label>
        <input type="file" id="nota_fiscal_image" name="nota_fiscal_image" class="from-control-file">
        <img src="/img/nota_fiscal_img_upload_user/{{ $produto->nota_fiscal_image }}" alt="{{ $produto->nome }}" class="img-preview">
    </div>
    <br>
    <div class="form-group">
        <label for="nome">Produto:</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Produto" value="{{ $produto->nome }}">
    </div>
    <br>
    <div class="form-group">
        <label for="categoria">Categoria:</label>
        <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Nome do Categoria" value="{{ $produto->categoria }}">
    </div>
    <br>
    <div class="form-group">
        <label for="valor">Valor:</label>
        <input type="number" min="0" class="form-control" id="valor" name="valor" placeholder="Valor do Produto" value="{{ $produto->valor }}">
    </div>
    <br>
    <div class="form-group">
        <label for="data_compra">Data de Compra:</label>
        <input type="date" class="form-control" id="data_compra" name="data_compra" value="{{ $produto->data_compra->format('Y-m-d') }}" >
    </div>
    <br>
    <div class="form-group">
        <label for="tempo_garantia_meses">Tempo Garantia (Mêses):</label>
        <input type="number" min="0" class="form-control" id="tempo_garantia_meses" name="tempo_garantia_meses" placeholder="Tempo de garantia do produto" value="{{ $produto->tempo_garantia_meses }}">
    </div>
    <br>
    <div class="form-group">
        <label for="observacao">Observação:</label>
        <textarea name="observacao" id="observacao" class="form-control" placeholder="Observações sobre o produto">{{ $produto->observacao }}</textarea>
    </div>
    <br>
        <input type="submit" class="btn btn-primary" value="Finalizar Edição">
    </form>
</div>

@endsection