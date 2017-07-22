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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/peticion','HomeController@index')->name('peticion');

Route::get('/peticion/numero/autocomplete','PeticionesController@numeroAutoComplete');
Route::post('/peticion/search/movimiento','PeticionesController@searchMovimiento');
Route::get('/peticion/data/table','PeticionesController@dataTable');
Route::resource('/peticion','PeticionesController');