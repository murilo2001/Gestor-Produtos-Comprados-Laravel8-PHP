@extends('layouts.main')

@section('title', $produto->nome)

@section('content')

<div class="col-md-10 offset-md-1">
    <div class="row">
        <div id="image-container" class="col-md-6">
        <img src="/img/nota_fiscal_img_upload_user/{{ $produto->nota_fiscal_image }}" class="img-fluid" alt=" {{$produto->nome}}"
        width="503" height="335">
        </div>
        <div id="info-container" class="col-md-6">
            <h1>{{ $produto->nome }}</h1>
            <p><ion-icon name="bag-handle-outline"></ion-icon>Categoria: {{ $produto->categoria->nome }}</p>
            <p><ion-icon name="cash-outline"></ion-icon>Valor: {{ $produto->valor }}</p>
            <p><ion-icon name="business-outline"></ion-icon>Estabelecimento de Compra: {{ $produto->estabelecimento_compra }}</p>
            <p><ion-icon name="calendar-number-outline"></ion-icon>Data de Compra: {{ $produto->data_compra->format('d/m/Y') }}</p>
            <p><ion-icon name="alarm-outline"></ion-icon>Tempo de Garantia: {{ $produto->tempo_garantia_meses }} meses, <span id="font-red"> {{ $tempoRestante }} </span></p>
            <p><ion-icon name="document-text-outline"></ion-icon>Observação: {{ $produto->observacao }}</p>
            <form action="/produtos/download/{{ $produto->id }}" method="GET">
                <button 
                    style="font-size: 14px"
                    type="submit"
                    class="btn btn-dark"><ion-icon
                    name="download-outline"></ion-icon> Download Imagem Nota Fiscal
                </button>
            </form>
    </div>
</div>

@endsection