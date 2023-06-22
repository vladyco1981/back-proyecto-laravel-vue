<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1/auth')->group(function(){
    Route::post('/login',[AuthController::class, "funLogin"]);
    Route::post('/register',[AuthController::class, "funRegistro"]);

    Route::middleware('auth:sanctum')->group(function (){
        Route::get('/v1/auth/perfil',[AuthController::class, "funPerfil"]);
        Route::post('/v1/auth/logout',[AuthController::class, "funSalir"]);
    });
});

