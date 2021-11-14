<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PostController, ComentarioController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('api')->prefix('v1')->group(function () {
    Route::get('/', function(){
        return response()->json(['servidor' => 'Iniciado com sucesso!', 'autor' => 'Marcos'], 200);
    });

    Route::apiResource('post', PostController::class);
    Route::apiResource('comentario', ComentarioController::class);

    Route::patch('post/{id}/updateAva', [PostController::class, 'updateAva']);
    Route::patch('comentario/{id}/updateAva', [ComentarioController::class, 'updateAva']);
});



