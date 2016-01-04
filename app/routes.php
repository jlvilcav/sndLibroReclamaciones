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

Route::get('pdf/{id}/x.pdf',array('uses' => 'libReclamosController@generarPDF'));

Route::get('/', array('uses' => 'libReclamosController@mostrarFormX'));

Route::get('/tipDocumento',array('uses' => 'tipDocuController@listaCombo') );
Route::post('/reclamo',array('uses' => 'libReclamosController@add') );



Route::get('/ubigeos',array('uses' => 'ubigeosController@index'));
Route::get('/ubigeos/prov/{id}',array('uses' => 'ubigeosController@listaProv'));
Route::get('/ubigeos/dis/{id}',array('uses' => 'ubigeosController@listaDist'));
Route::get('/pernatural/busca/{dni}', array('uses' => 'perNaturalController@findByDni'));
Route::get('/perjuridica/busca/{ruc}', array('uses' => 'perJuridicaController@findByRuc'));


//Route::get('/pernatural',array('uses' => 'perNaturalController@'));
//Route::get('/tipDocumento',array('uses' => 'tipDocuController@index'));