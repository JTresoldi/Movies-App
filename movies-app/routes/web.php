<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\ProfileController;

//Home + Filmes
Route::get('/', [MovieController::class, 'index'])->name('home');
Route::get('/filme/{id}', [MovieController::class, 'show'])->name('filme.detalhes');
Route::get('/buscar', [MovieController::class, 'buscar'])->name('buscar');

//Autenticacao
Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/registrar', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('/registrar', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/perfil', fn () => view('perfil'))->middleware('auth')->name('perfil');

//Listas (privadas do usuário)
Route::middleware('auth')->group(function () {
    Route::get('/listas', [ListController::class,'index'])->name('listas.index');
    Route::get('/listas/criar', [ListController::class,'create'])->name('listas.create');
    Route::post('/listas', [ListController::class,'store'])->name('listas.store');
    Route::get('/listas/{lista}', [ListController::class,'show'])->name('listas.show');
    Route::delete('/listas/{lista}', [ListController::class,'destroy'])->name('listas.destroy');
    Route::post('/listas/{lista}/adicionar', [ListController::class,'addMovie'])->middleware('auth')->name('listas.addMovie');
    Route::delete('/listas/{lista}/remover/{movie}', [ListController::class,'removeMovie'])->name('listas.removeMovie');
});

//Listas públicas
Route::get('/listas-publicas', [ListController::class,'publicIndex'])->name('listas.public');
Route::get('/listas-publicas/{lista}', [ListController::class,'publicShow'])->name('listas.public.show');

//Perfil do usuário
Route::middleware('auth')->group(function () {
    Route::get('/perfil/editar', [ProfileController::class, 'edit'])->name('perfil.editar');
    Route::post('/perfil',        [ProfileController::class, 'update'])->name('perfil.atualizar');
});

// Perfil público (não precisa login)
Route::get('/u/{user}', [ProfileController::class, 'public'])->name('perfil.publico');