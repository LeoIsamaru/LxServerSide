<?php

use App\Http\Controllers\TaskAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/task/{task}', [TaskAPIController::class, 'show']);
// update ao da linha 11, abaixo:
Route::apiResource('/task', TaskAPIController::class); //esta linha cria as 4 rotas do CRUD!
