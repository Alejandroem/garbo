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
Route::get('/peticion/aprobar/{peticion}','PeticionesController@aprobar')->name('peticion.aprobar');;
Route::get('/peticion/denegar/{peticion}','PeticionesController@denegar')->name('peticion.denegar');;
Route::resource('/peticion','PeticionesController');