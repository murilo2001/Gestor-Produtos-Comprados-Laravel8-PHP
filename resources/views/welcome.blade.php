@extends('layouts.main')

@section('title', 'Gestor de Produtos Comprados')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um Produto</h1>
    <form action="/" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">
    </form>
</div>

@endsection