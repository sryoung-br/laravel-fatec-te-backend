<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return response()->json(['servidor' => 'Iniciado com sucesso!', 'autor' => 'Marcos'], 200);
})->middleware('allow');

Route::get('token', function(){
    $token = csrf_token();
    return response()->json(['token' => $token]);
});

