@extends('layouts.main')

@section('title', 'Editando Produto: '. $produto->nome)

@section('content')

<div id="produto-create-container" class="col-md-6 offset-md-3">
    <h1>Editando: {{ $produto->nome }}</h1>
    <br>
    <form action="/produtos/update/{{ $produto->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="image">Imagem da Nota Fiscal do Produto</label>
        <input type="file" id="nota_fiscal_image" name="nota_fiscal_image" class="from-control-file">
        <img src="/img/nota_fiscal_img_upload_user/{{ $produto->nota_fiscal_image }}" alt="{{ $produto->nome }}" class="img-preview">
        <br>
        @error('nota_fiscal_image')
            <span class="validacao-container"><small>{{$message}}</small></span> 
        @enderror
    </div>
    <br>
    <div class="form-group">
        <label for="nome">Produto</label><font color="red">*</font>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Produto" value="{{ $produto->nome }}">
        @error('nome')
            <span class="validacao-container"><small>{{$message}}</small></span> 
        @enderror
    </div>
    <br>
        <div class="form-group">
            <label for="categoria">Categoria</label><font color="red">*</font>
                <select class="custom-select" id="categoria_id" name="categoria_id">
                    @foreach($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                    @endforeach
                </select>
        </div>
        @error('categoria_id')
            <span class="validacao-container"><small>{{$message}}</small></span> 
        @enderror
    <br>
    <div class="form-group">
        <label for="valor">Valor</label><font color="red">*</font>
        <input type="number" min="0" class="form-control" id="valor" name="valor" placeholder="Valor do Produto" value="{{ $produto->valor }}">
        @error('valor')
            <span class="validacao-container"><small>{{$message}}</small></span> 
        @enderror
    </div>
    <br>
    <div class="form-group">
        <label for="data_compra">Data de Compra</label><font color="red">*</font>
        <input type="date" class="form-control" id="data_compra" name="data_compra" value="{{ $produto->data_compra->format('Y-m-d') }}" >
        @error('data_compra')
            <span class="validacao-container"><small>{{$message}}</small></span> 
        @enderror
    </div>
    <br>
    <div class="form-group">
        <label for="tempo_garantia_meses">Tempo Garantia (Mêses)</label><font color="red">*</font>
        <input type="number" min="0" class="form-control" id="tempo_garantia_meses" name="tempo_garantia_meses" placeholder="Tempo de garantia do produto" value="{{ $produto->tempo_garantia_meses }}">
        @error('tempo_garantia_meses')
            <span class="validacao-container"><small>{{$message}}</small></span> 
        @enderror
    </div>
    <br>
    <div class="form-group">
        <label for="observacao">Observação:</label>
        <textarea name="observacao" id="observacao" class="form-control" placeholder="Observações sobre o produto">{{ $produto->observacao }}</textarea>
        @error('observacao')
            <span class="validacao-container"><small>{{$message}}</small></span> 
        @enderror
    </div>
    <br>
        <input type="submit" class="btn btn-primary" value="Finalizar Edição">
    </form>
</div>

@endsection