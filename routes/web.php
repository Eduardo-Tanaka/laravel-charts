<?php

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

Route::get('/', 'HomesController@index');

Route::get('/charts/barra', 'ChartsController@barra');
Route::get('/charts/linha', 'ChartsController@linha');

Route::get('/charts/index', 'ChartsController@index');
Route::get('/charts/cadastrar', 'ChartsController@cadastrar');
Route::post('/charts', 'ChartsController@gravar');

Route::get('/charts/show/{mes}', 'ChartsController@show');

Route::get('/charts/{id}/quantidade/{quantidade}', 'ChartsController@edit');

Route::get('/charts/graficojsonbar', 'ChartsController@graficojsonbar');

Route::get('/charts/graficojsonline/{mes}', 'ChartsController@graficojsonline');