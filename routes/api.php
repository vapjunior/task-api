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

Route::get('/tasks', 'API\TaskController@index');
Route::post('/tasks', 'API\TaskController@store');
Route::put('/tasks/{task}', 'API\TaskController@update');
Route::delete('/tasks/{task}', 'API\TaskController@destroy');