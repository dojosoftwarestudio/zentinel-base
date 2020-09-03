<?php

use Illuminate\Support\Facades\Route;


Route::get('/{any}', 'ZentinelController@index')->where('any', '.*');
