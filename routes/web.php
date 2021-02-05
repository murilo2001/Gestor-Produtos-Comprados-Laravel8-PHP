<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

/* Rota GET para redirecionar usuario para view index */
Route::get('/',[ProdutoController::class, 'index']);

/* Rota GET para redirecionar usuario para view de cadastro de produto */
Route::get('/produtos/cadastrar',[ProdutoController::class, 'create'])->middleware('auth'); //->middleware('auth') rota excluisa para usuarios logados

/* Rota POST para encaminhar request para action (store) cujá função é o cadastro de produtos no banco de dados */
Route::post('/produtos',[ProdutoController::class, 'store'])->middleware('auth'); //->middleware('auth') rota excluisa para usuarios logados

/* Rota GET para redirecionar usuario para view de edição de produto */
Route::get('/produtos/edit/{id}', [ProdutoController::class, 'edit'])->middleware('auth'); //->middleware('auth') rota excluisa para usuarios logados

/* Rota PUT para encaminhar request para action (update) cujá função é a edição de registros de produtos no banco */
Route::put('/produtos/update/{id}', [ProdutoController::class, 'update'])->middleware('auth'); //->middleware('auth') rota excluisa para usuarios logados

/* Rota GET para redirecionar usuario para view de espeção do produto */
Route::get('/produtos/{id}', [ProdutoController::class, 'show'])->middleware('auth'); //->middleware('auth') rota excluisa para usuarios logados

/* Rota GET para redirecionar usuario para view de edição de produto */
Route::get('/produtos/download/{id}', [ProdutoController::class, 'download_nota_fiscal_image'])->middleware('auth'); //->middleware('auth') rota excluisa para usuarios logados

/* Rota GET para redirecionar usuario para view dashboard */
Route::get('/dashboard', [ProdutoController::class, 'dashboard'])->middleware('auth'); //->middleware('auth') rota excluisa para usuarios logados

/* Rota DELETE para redirecionar usuario para a action destroy cujá função é a deleção de um registro do banco de dados */
Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy'])->middleware('auth'); //->middleware('auth') rota excluisa para usuarios logados