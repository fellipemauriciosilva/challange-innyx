<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    // Rotas autenticadas aqui

    // Rotas para produtos
    Route::get('/produtos', [ProdutoController::class, 'index']); // Listar todos os produtos
    Route::get('/produtos/{id}', [ProdutoController::class, 'show']); // Mostrar detalhes de um produto específico
    Route::post('/produtos', [ProdutoController::class, 'store']); // Criar um novo produto
    Route::put('/produtos/{id}', [ProdutoController::class, 'update']); // Atualizar um produto
    Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy']); // Excluir um produto
    Route::get('/produtos/buscar/{termo}', [ProdutoController::class, 'buscar']); // Buscar por nome ou descrição

    // Rotas para categorias
    Route::get('/categorias', [CategoriaController::class, 'index']); // Listar todas as categorias
    Route::get('/categorias/{id}', [CategoriaController::class, 'show']); // Mostrar detalhes de uma categoria específica
    Route::post('/categorias', [CategoriaController::class, 'store']); // Criar uma nova categoria
    Route::put('/categorias/{id}', [CategoriaController::class, 'update']); // Atualizar uma categoria
    Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy']); // Excluir uma categoria
});

Route::post('/login', [AuthController::class, 'login']);
