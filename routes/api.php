<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\ServicoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//* Serviços
Route::post('store', [ServicoController::class, 'store']);

Route::get('find/{id}', [ServicoController::class, 'pesquisarPorId']);

Route::post('nome', [ServicoController::class, 'pesquisaPorNome']);

Route::get('all', [ServicoController::class, 'retornarTodos']);

Route::put('atualizar',[ServicoController::class, 'update']);

Route::delete('delete/{id}',[ServicoController::class, 'excluir']);


//* Clientes
Route::post('registro',[ClienteController::class, 'store']);

Route::get('pesquisa/{id}', [ClienteController::class, 'pesquisaPorId']);

Route::post('buscaNome', [ClienteController::class, 'pesquisarPorNome']);

Route::post('cpf', [ClienteController::class, 'pesquisarPorCpf']);

Route::post('email', [ClienteController::class, 'pesquisarPorEmail']);

Route::post('celular', [ClienteController::class, 'pesquisarPorCelular']);

Route::get('todos', [ClienteController::class, 'retornarTodosClientes']);

Route::put('cliente/atualizar',[ClienteController::class, 'atualizarClientes']);

Route::delete('excluir/{id}',[ClienteController::class, 'excluirCliente']);

Route::post('recuperarSenhas', [ClienteController::class, 'recuperarSenha']);

// Profissionals
Route::post('cadastro', [ProfissionalController::class, 'store']);

Route::get('pesquisar/{id}', [ProfissionalController::class, 'pesquisandoPorId']);

Route::post('procurarNome' , [ProfissionalController::class, 'pesquisandoPorNome']);

Route::post('pesquisarCpf', [ProfissionalController::class, 'pesquisandoPorCpf']);

Route::post('pesquisarEmail', [ProfissionalController::class, 'pesquisandoPorEmail']);

Route::get('pesquisarTodos', [ProfissionalController::class, 'retornandoTodosProfissionais']);

Route::put('update',[ProfissionalController::class, 'atualizarProfissional']);

Route::delete('deletar/{id}', [ProfissionalController::class, 'deletarProfissional']);

Route::post('senha', [ProfissionalController::class, 'redefinirSenha']);

//* Agendamento

Route::put('updateAgenda', [AgendaController::class, 'atualizarAgenda']);

Route::delete('deletarAgenda/{id}', [AgendaController::class, 'deletarAgenda']);

Route::get('todosAgenda', [AgendaController::class, 'retornarTodosAgenda']);

Route::post('pesquisaHorarios', [AgendaController::class, 'pesquisarPorData']);

Route::get('pesquisaIdAgenda/{id}', [AgendaController::class, 'pesquisarPorIdAgenda']);

Route::post('criarAgendaProfissional', [AgendaController::class, 'criarHorarioProfissional']);

Route::post('criarAgendaFindProfissional', [AgendaController::class, 'agendaFindTimeProfissional']);






