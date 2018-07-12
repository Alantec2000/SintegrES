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

Route::group(["middleware"=>["user"]], function(){
	Route::get('/', "HomeController@load")->name('home');
	
	Route::get('/consulta/get/{id_consulta}', "SintegraController@getDetalhesConsulta");
	Route::get('/consulta/delete/{id_consulta}', "SintegraController@removerConsulta");
	
	Route::get('autenticar', function () {
		return view('autenticar');
	})->name('autenticar');
});


Route::get('consulta/sintegra/{cnpj}','SintegraController@getInformacaoEmpresa');
Route::get('usuario/sair','UsuarioController@sair');
Route::post('usuario/login','UsuarioController@autenticar');