<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes(['register' => true]);

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/contas', 'App\Http\Controllers\crmController@ConsultaContas')->name('ConsultaContas')->middleware('auth');
Route::get('/novaconta', function () {
    return view('cadastraempresa');
})->middleware('auth');;

Route::get('/novoproduto', function () {
    return view('cadproduto');
})->middleware('auth');;

Route::get('/novofuncionario', function () {
    return view('cadfuncionario');
})->middleware('auth');;

Route::get('/novaetapa', function () {
    return view('cadfluxoop');
})->middleware('auth');;

Route::get('buscacnpj', 'App\Http\Controllers\crmController@BuscaCNPJ')->name('buscacnpj')->middleware('auth');;

Route::get('cadempresa', 'App\Http\Controllers\crmController@CadEmpresa')->name('cadempresa')->middleware('auth');;

Route::get('/acessarempresa', 'App\Http\Controllers\crmController@acessarempresa')->name('acessarempresa')->middleware('auth');;

Route::get('/editaempresa', 'App\Http\Controllers\crmController@editaempresa')->name('editaempresa')->middleware('auth');;

Route::get('/atualizaempresa', 'App\Http\Controllers\crmController@atualizaempresa')->name('atualizaempresa')->middleware('auth');;

Route::get('/cadcontato', 'App\Http\Controllers\crmController@cadcontato')->name('cadcontato')->middleware('auth');;

Route::post('/novocontato', 'App\Http\Controllers\crmController@novocontato')->middleware('auth');

Route::post('/editacontato', 'App\Http\Controllers\crmController@editacontato')->middleware('auth');

Route::post('/atualizacontato', 'App\Http\Controllers\crmController@atualizacontato')->middleware('auth');

Route::post('/acessarcontato', 'App\Http\Controllers\crmController@acessarcontato')->middleware('auth');

Route::get('/pesquisarconta', 'App\Http\Controllers\crmController@pesquisarconta')->name('pesquisarconta')->middleware('auth');;

Route::get('/produtos', 'App\Http\Controllers\crmController@consultaprodutos')->name('produtos')->middleware('auth');;

Route::post('/cadproduto', 'App\Http\Controllers\crmController@cadproduto')->name('cadproduto')->middleware('auth');

Route::post('/editaproduto', 'App\Http\Controllers\crmController@editaproduto')->name('editaproduto')->middleware('auth');

Route::post('/atualizaproduto', 'App\Http\Controllers\crmController@atualizaproduto')->name('atualizaproduto')->middleware('auth');

Route::get('/pesquisarproduto','App\Http\Controllers\crmController@pesquisarproduto')->name('pesquisarproduto')->middleware('auth');;

Route::get('/pesquisarcontato','App\Http\Controllers\crmController@pesquisarcontato')->name('pesquisarcontato')->middleware('auth');;

Route::get('/contatos','App\Http\Controllers\crmController@consultacontatos')->name('contatos')->middleware('auth');;

Route::get('/funcionarios','App\Http\Controllers\crmController@consultafuncionarios')->name('funcionarios')->middleware('auth');;

Route::get('/atividades','App\Http\Controllers\crmController@consultaatividades')->name('atividades')->middleware('auth');;

Route::post('/cadfuncionario', 'App\Http\Controllers\crmController@cadfuncionario')->name('cadfuncionario')->middleware('auth');

Route::post('/editafuncionario', 'App\Http\Controllers\crmController@editafuncionario')->name('editafuncionario')->middleware('auth');

Route::post('/atualizafuncionario', 'App\Http\Controllers\crmController@atualizafuncionario')->name('atualizafuncionario')->middleware('auth');

Route::post('/cadastrarop', 'App\Http\Controllers\crmController@cadastrarop')->name('cadastrarop')->middleware('auth');

Route::get('/pesquisafuncionario','App\Http\Controllers\crmController@pesquisafuncionario')->name('pesquisafuncionario')->middleware('auth');;

Route::get('/pesquisaatividade','App\Http\Controllers\crmController@pesquisaatividade')->name('pesquisaatividade')->middleware('auth');;

Route::get('/novaop','App\Http\Controllers\crmController@cadop')->name('novaop')->middleware('auth');;

Route::get('/consultaop','App\Http\Controllers\crmController@consultaop')->name('consultaop')->middleware('auth');;

Route::get('/pesquisarop','App\Http\Controllers\crmController@pesquisarop')->name('pesquisarop')->middleware('auth');;

Route::post('/acessarop', 'App\Http\Controllers\crmController@acessarop')->name('acessarop')->middleware('auth');

Route::post('/cadetapa', 'App\Http\Controllers\crmController@cadetapa')->name('cadetapa')->middleware('auth');

Route::get('/consultafluxoop','App\Http\Controllers\crmController@consultafluxoop')->name('consultafluxoop')->middleware('auth');;

Route::get('/pesquisaetapa','App\Http\Controllers\crmController@pesquisaetapa')->name('pesquisaetapa')->middleware('auth');;

Route::post('/editaetapa', 'App\Http\Controllers\crmController@editaetapa')->name('editaetapa')->middleware('auth');

Route::post('/atualizaetapafluxoop', 'App\Http\Controllers\crmController@atualizaetapafluxoop')->name('atualizaetapafluxoop')->middleware('auth');

Route::post('/excluir_registro', 'App\Http\Controllers\crmController@excluir_registro')->name('excluir_registro')->middleware('auth');

Route::post('/editaop', 'App\Http\Controllers\crmController@acessarop')->name('editaop')->middleware('auth');

Route::post('/atualizaop', 'App\Http\Controllers\crmController@atualizaop')->name('atualizaop')->middleware('auth');

Route::post('/novaatividade', 'App\Http\Controllers\crmController@novaatividade')->name('novaatividade')->middleware('auth');

Route::get('/atualizaetapaop', 'App\Http\Controllers\crmController@atualizaetapaop')->name('atualizaetapaop')->middleware('auth');

Route::post('/cadatividade', 'App\Http\Controllers\crmController@cadatividade')->name('cadatividade')->middleware('auth');

Route::post('/editaatividade', 'App\Http\Controllers\crmController@editaatividade')->name('editaatividade')->middleware('auth');

Route::post('/atualizaatividade', 'App\Http\Controllers\crmController@atualizaatividade')->name('atualizaatividade')->middleware('auth');

Route::get('pesquisaparceiroop', 'App\Http\Controllers\crmController@pesquisaparceiroop')->name('pesquisaparceiroop')->middleware('auth');;

Route::post('/anexar', 'App\Http\Controllers\crmController@anexar')->name('anexar')->middleware('auth');

Route::post('/baixararquivo', 'App\Http\Controllers\crmController@baixararquivo')->name('baixararquivo')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
