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
$nameSpaceSIRIN = "App\\Http\\Controllers\\Sirin\\";
$nameSpaceBase = "App\\Http\\Controllers\\";


Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', ['as' => 'login', 'uses' => 'AuthController@login']);
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('profile', 'AuthController@profile');

});

Route::get('test/', $nameSpaceSIRIN.'Test@index');
Route::get('test/list', $nameSpaceSIRIN.'Test@list');


Route::get('solicitud/list', $nameSpaceBase.'SolicitudController@list');
Route::get('solicitud/eventos/{id}', $nameSpaceBase.'SolicitudController@eventos');
Route::get('solicitud/{id}', $nameSpaceBase.'SolicitudController@show');
Route::get('missolicitudes/{id}', $nameSpaceBase.'SolicitudController@listTecnico');
Route::get('solicitados/{id}', $nameSpaceBase.'SolicitudController@listSolicitados');
Route::post('filtrar', $nameSpaceBase.'SolicitudController@listBy');
Route::post('solicitar', $nameSpaceBase.'SolicitudController@store');
Route::post('set', $nameSpaceBase.'SolicitudController@setEstado');
Route::post('derivar', $nameSpaceBase.'SolicitudController@setCategoria');

#categoriaas
Route::get('category/list', $nameSpaceBase.'CategoryController@list');
Route::post('category/create', $nameSpaceBase.'CategoryController@store');
Route::delete('category/delete/{id}', $nameSpaceBase.'CategoryController@destroy');
Route::post('category/filter', $nameSpaceBase.'CategoryController@listBy');
#usuarios
Route::get('user/list', $nameSpaceBase.'UserController@list');
Route::post('user/create', $nameSpaceBase.'UserController@store');
#rol
Route::get('rol/list', $nameSpaceBase.'RolController@list');
#Persona
Route::get('persona/list', $nameSpaceBase.'PersonaController@list');
Route::post('persona/create', $nameSpaceBase.'PersonaController@store');
Route::post('persona/update', $nameSpaceBase.'PersonaController@update');
Route::get('persona/{id}', $nameSpaceBase.'PersonaController@show');
#estado
Route::get('estado/list', $nameSpaceBase.'EstadoController@list');
Route::post('estado/create', $nameSpaceBase.'EstadoController@store');
Route::post('estado/update', $nameSpaceBase.'EstadoController@update');
Route::get('estado/{id}', $nameSpaceBase.'EstadoController@show');
#Acciones de sobre la solicitud
Route::post('tecnico/derivar', $nameSpaceBase.'TecnicoController@derivar');
Route::post('tecnico/recategorizar', $nameSpaceBase.'TecnicoController@recategorizar');
Route::post('tecnico/rechazar', $nameSpaceBase.'TecnicoController@rechazar');
Route::post('tecnico/finalizar', $nameSpaceBase.'TecnicoController@finalizar');
