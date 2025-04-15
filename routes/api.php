<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::post('/usuarios', [UsuarioController::class, 'index']);
Route::post('/registrarUsuario', [UsuarioController::class, 'registrarUsuario']);
Route::post('/actualizarUsuario', [UsuarioController::class, 'actualizarUsuario']);






