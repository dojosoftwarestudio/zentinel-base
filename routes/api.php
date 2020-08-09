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
Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', ['as' => 'login', 'uses' => 'AuthController@login']);
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('profile', 'AuthController@profile');

});
Route::get('list', 'SolicitudController@list');
Route::get('solicitud/{id}', 'SolicitudController@show');
Route::get('missolicitudes/{id}', 'SolicitudController@listTecnico');
Route::get('solicitados/{id}', 'SolicitudController@listSolicitados');
Route::post('filtrar', 'SolicitudController@listBy');
Route::post('solicitar', 'SolicitudController@store');
Route::post('set', 'SolicitudController@setEstado');
Route::post('derivar', 'SolicitudController@setCategoria');

#categoriaas
Route::get('category/list', 'CategoryController@list');
Route::post('category/create', 'CategoryController@store');
Route::post('category/filter', 'CategoryController@listBy');