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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/options', 'API\OptionController',['except' => ['create','edit']]);

Route::get('/perkuliahan', 'API\SaitController@index');
Route::get('/perkuliahan/{nim}', 'API\SaitController@show');

Route::get('/matakuliah', 'API\SaitController@matakuliah'); 

Route::post('/perkuliahan', 'API\SaitController@create_join');

Route::put('/perkuliahan', 'API\SaitController@update_join');
Route::delete('/perkuliahan', 'API\SaitController@destroy');
