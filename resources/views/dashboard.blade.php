@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-titulo-container">
    <h1>Lista de Produtos</h1>
    <button type="button" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#modalExcluirCategoria"><ion-icon name="trash-outline"></ion-icon> Deletar Categorias</button>
</div>
<div class="col-md-10 offset-md-1 dashboard-produtos-container">
    @if(count($produtos) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Categoria</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produtos as $produto)
            <tr>
                <td scope="row">{{ $loop->index + 1 }}</td>
                <td><a href="/produtos/{{ $produto->id }}">{{ $produto->nome }}</a></td>
                <td><a href="/produtos/{{ $produto->id }}">{{ $produto->categoria->nome }}</a></td>
                <td>
                    <a href="/produtos/edit/{{ $produto->id }}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon> Editar</a> 
                    <form action="/produtos/{{ $produto->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon> Deletar</button>
                    </form>
                </td>
            </tr>
    
            @endforeach
        </tbody>
    </table>
    @else
    <p>Você não tem nenhum produto cadastrado, <a href="/produtos/cadastrar">clique aqui para cadastrar um novo produto</a></p>
    @endif
</div>

{{-- Inicio Modal Categoria --}}
<div class="modal fade" id="modalExcluirCategoria" tabindex="-1" role="dialog" aria-labelledby="modalExcluirCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalExcluirCategoriaLabel">Lista de Categorias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            @if(count($categorias) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorias as $categoria)
                    <tr>
                        <td scope="row">{{ $loop->index + 1 }}</td>
                        <td><a href="/produtos/{{ $categoria->id }}">{{ $categoria->nome }}</a></td>
                        <td>
                            <form action="/categorias/{{ $categoria->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#modalExcluirCategoria"><ion-icon name="trash-outline"></ion-icon></button>
                            
                            </form>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            </div>
            <div class="modal-footer">
                <nav class="mx-auto" aria-label="Page navegation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Proximo</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
{{-- FIM Modal Categoria --}}

@endsection