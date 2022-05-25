<?php

Route::get ('/', "RequerimentoPericiaController@create");
Route::post('/guardar', 'RequerimentoPericiaController@guardar')->name('guardar');
Route::get('/sucesso', 'RequerimentoPericiaController@sucesso')->name('sucesso');

Route::get ('/confirmar', "RequerimentoPericiaController@confirmar");
Route::post('requerimento_pericias/confirma', 'RequerimentoPericiaController@confirmacao');

Route::get ("/login", 		"AuthController@login")->name('login');
Route::post('/login', 		"AuthController@entrar");
Route::get ('/logout', 		'AuthController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function () {

	Route::get ('/alterasenha',					'UserController@AlteraSenha');
	Route::post('/salvasenha',   				'UserController@SalvarSenha');
	Route::post('/enviarsenhausuario',			'UserController@EnviarSenhaUsuario');
	Route::post('/zerarsenhausuario',   		'UserController@ZerarSenhaUsuario');
	
	Route::get('/home', 'HomeController@index')->name('home');
	
	Route::get('/requerimentos', 'RequerimentoPericiaController@index')->name('requerimentos');
	Route::get('/arquivo', 'RequerimentoPericiaController@arquivo')->name('arquivo');
	
	Route::get('/diario', 'RequerimentoPericiaController@diario')->name('diario');
	Route::post('/requerimento_pericias/{id}/presente', 'RequerimentoPericiaController@presente')->name('presente');
	Route::post('/requerimento_pericias/{id}/ausente', 'RequerimentoPericiaController@ausente')->name('ausente');

	Route::get('/requerimento_pericias/reagendar', 'RequerimentoPericiaController@reagendar')->name('reagendar');
	Route::post('/requerimento_pericias/reagendar', 'RequerimentoPericiaController@reagendamento')->name('reagendamento');
	Route::post('/requerimento_pericias/confirmar', 'RequerimentoPericiaController@confirmacaointerna')->name('requerimentos.confirmacaointerna');

	Route::get('relatorio/pdf/{data}',  'RelatorioController@gerarpdf');
	Route::get('export-the-docx/{data}', 'RelatorioController@exportDocsFile');

	Route::resource('requerimento_pericias', 'RequerimentoPericiaController');
	Route::resource('user', 'UserController');
	Route::resource('relatorio', 'RelatorioController');
});