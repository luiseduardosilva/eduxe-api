<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1/empresas')->group(function() {
    Route::get('/', "Api\EmpresaController@index");
    Route::get('/{id}', "Api\EmpresaController@show");
    Route::post('/', "Api\EmpresaController@store");
    Route::put('/{id}', "Api\EmpresaController@update");
    Route::delete('/{id}', "Api\EmpresaController@destroy");
});


Route::prefix('v1/segmentos')->group(function() {
    Route::get('/', "Api\SegmentoController@index");
});
