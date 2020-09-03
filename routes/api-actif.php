<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('user/list', 'UserController@list');
Route::post('user/create', 'UserController@store');
