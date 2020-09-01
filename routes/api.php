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


Route::get('solicitud/list', 'SolicitudController@list');
Route::get('solicitud/eventos/{id}', 'SolicitudController@eventos');
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
Route::delete('category/delete/{id}', 'CategoryController@destroy');
Route::post('category/filter', 'CategoryController@listBy');
#usuarios
Route::get('user/list', 'UserController@list');
Route::post('user/create', 'UserController@store');
#rol
Route::get('rol/list', 'RolController@list');
#Persona
Route::get('persona/list', 'PersonaController@list');
Route::post('persona/create', 'PersonaController@store');
Route::post('persona/update', 'PersonaController@update');
Route::get('persona/{id}', 'PersonaController@show');
#estado
Route::get('estado/list', 'EstadoController@list');
Route::post('estado/create', 'EstadoController@store');
Route::post('estado/update', 'EstadoController@update');
Route::get('estado/{id}', 'EstadoController@show');
#Acciones de sobre la solicitud
Route::post('tecnico/derivar', 'TecnicoController@derivar');
Route::post('tecnico/recategorizar', 'TecnicoController@recategorizar');
Route::post('tecnico/rechazar', 'TecnicoController@rechazar');
Route::post('tecnico/finalizar', 'TecnicoController@finalizar');
