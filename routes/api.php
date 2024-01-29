<?php

use App\Http\Controllers\AdministradorController;
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

Route::put('recuperarSenhas', [ClienteController::class, 'recuperarSenha']);

// Profissionais
Route::post('cadastro', [ProfissionalController::class, 'store']);

Route::get('pesquisar/{id}', [ProfissionalController::class, 'pesquisandoPorId']);

Route::post('procurarNome' , [ProfissionalController::class, 'pesquisandoPorNome']);

Route::post('pesquisarCpf', [ProfissionalController::class, 'pesquisandoPorCpf']);

Route::post('pesquisarEmail', [ProfissionalController::class, 'pesquisandoPorEmail']);

Route::post('pesquisaPorCelular', [ProfissionalController::class, 'pesquisarPorCelular']);

Route::get('pesquisarTodos', [ProfissionalController::class, 'retornandoTodosProfissionais']);

Route::put('update',[ProfissionalController::class, 'atualizarProfissional']);

Route::delete('deletar/{id}', [ProfissionalController::class, 'deletarProfissional']);

Route::put('senha', [ProfissionalController::class, 'redefinirSenha']);

//* Agendamento

Route::put('updateAgenda', [AgendaController::class, 'atualizarAgenda']);

Route::delete('deletarAgenda/{id}', [AgendaController::class, 'deletarAgenda']);

Route::get('todosAgenda', [AgendaController::class, 'retornarTodosAgenda']);

Route::post('pesquisaHorarios', [AgendaController::class, 'pesquisarPorData']);

Route::get('pesquisaIdAgenda/{id}', [AgendaController::class, 'pesquisarPorIdAgenda']);

Route::post('criarAgendaProfissional', [AgendaController::class, 'criarHorarioProfissional']);

Route::post('criarAgendaFindProfissional', [AgendaController::class, 'agendaFindTimeProfissional']);

//*ADM  Cadastro de Clientes

Route::post('adm/cadastroCliente', [ClienteController::class, 'store']);

Route::get('adm/pesquisar/{id}', [ClienteController::class, 'pesquisaPorId']);

Route::post('adm/buscaNome', [ClienteController::class, 'pesquisarPorNome']);

Route::post('adm/cpf', [ClienteController::class, 'pesquisarPorCpf']);

Route::post('adm/email', [ClienteController::class, 'pesquisarPorEmail']);

Route::post('adm/celular', [ClienteController::class, 'pesquisarPorCelular']);

Route::get('adm/todosClientes', [ClienteController::class, 'retornarTodosClientes']);

Route::put('adm/cliente/atualizar',[ClienteController::class, 'atualizarClientes']);

Route::delete('adm/excluir/{id}',[ClienteController::class, 'excluirCliente']);

Route::put('adm/recuperarSenhas', [ClienteController::class, 'recuperarSenha']);

//* ADM Cadastro de Profissionais

Route::post('adm/cadastro', [ProfissionalController::class, 'store']);

Route::get('adm/pesquisar/{id}', [ProfissionalController::class, 'pesquisandoPorId']);

Route::post('adm/procurarNome' , [ProfissionalController::class, 'pesquisandoPorNome']);

Route::post('adm/pesquisarCpf', [ProfissionalController::class, 'pesquisandoPorCpf']);

Route::post('adm/pesquisarEmail', [ProfissionalController::class, 'pesquisandoPorEmail']);

Route::post('adm/pesquisaPorCelular', [ProfissionalController::class, 'pesquisarPorCelular']);

Route::get('adm/pesquisarTodos', [ProfissionalController::class, 'retornandoTodosProfissionais']);

Route::put('adm/update',[ProfissionalController::class, 'atualizarProfissional']);

Route::delete('adm/deletar/{id}', [ProfissionalController::class, 'deletarProfissional']);

Route::put('adm/senha', [ProfissionalController::class, 'redefinirSenha']);

//* ADM Cadastro de Serviços

Route::post('adm/servico/cadastro', [ServicoController::class, 'store']);

Route::get('adm/servico/pesquisa/{id}', [ServicoController::class, 'pesquisarPorId']);

Route::post('adm/servico/pesquisaPorNome', [ServicoController::class, 'pesquisaPorNome']);

Route::get('adm/servico/retornarTodos', [ServicoController::class, 'retornarTodos']);

Route::put('adm/servico/atualizar',[ServicoController::class, 'update']);

Route::delete('adm/servico/delete/{id}',[ServicoController::class, 'excluir']);

//* ADM Cadastro do Agendamento

Route::put('adm/updateAgenda', [AgendaController::class, 'atualizarAgenda']);

Route::delete('adm/deletarAgenda/{id}', [AgendaController::class, 'deletarAgenda']);

Route::get('adm/todosAgenda', [AgendaController::class, 'retornarTodosAgenda']);

Route::post('adm/pesquisaHorarios', [AgendaController::class, 'pesquisarPorData']);

Route::get('adm/pesquisaIdAgenda/{id}', [AgendaController::class, 'pesquisarPorIdAgenda']);

Route::post('adm/criarAgendaProfissional', [AgendaController::class, 'criarHorarioProfissional']);

Route::post('adm/criarAgendaFindProfissional', [AgendaController::class, 'agendaFindTimeProfissional']);

//* Cadastro de ADMs

Route::post('cadastro/adm', [AdministradorController::class, 'cadastroAdm']);

Route::post('pesquisa/email/adm', [AdministradorController::class , 'pesquisaPorEmailAdm']);

Route::post('pesquisa/cpf/adm', [AdministradorController::class, 'pesquisaPorCpfAdm']);

Route::post('pesquisa/celular/adm', [AdministradorController::class, 'pesquisPorCelularAdm']);

Route::post('pesquisa/nome/adm', [AdministradorController::class, 'pesquisaPorNomeAdm']);

Route::get('retornarTodosAdms', [AdministradorController::class, 'retornarTodosAdm']);

Route::get('pesquisa/adm/{id}', [AdministradorController::class, 'pesquisaPorIdAdm']);

Route::delete('excluir/adm/{id}', [AdministradorController::class, 'deletarAdm']);

Route::put('atualizar/adm', [AdministradorController::class, 'atualizarAdm']);











