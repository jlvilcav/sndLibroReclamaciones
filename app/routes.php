<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::get('/',array('uses' => 'libReclamosController@mostrarForm') );
Route::get('/', function(){
return View::make('nuevoReclamo');
});

Route::get('/tipDocumento',array('uses' => 'tipDocuController@mostrarForm') );


Route::get('/ubigeos',array('uses' => 'ubigeosController@index'));
Route::get('/pernatual',array('uses' => 'perNaturalController@add'));
//Route::get('/tipDocumento',array('uses' => 'tipDocuController@index'));