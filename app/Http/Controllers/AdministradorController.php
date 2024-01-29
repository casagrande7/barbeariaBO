<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdministradorFormRequest;
use App\Http\Requests\UpdateAdmFormRequest;
use App\Http\Requests\UpdateFormRequest;
use App\Models\Administrador;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    public function cadastroAdm(AdministradorFormRequest $request)
    {
        $adm = Administrador::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'celular' => $request->celular,
            'senha' => $request->senha
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Administrador cadastrado com sucesso',
            'data' => $adm
        ], 200);
    }

    public function pesquisaPorIdAdm($id)
    {
        $adm = Administrador::find($id);
        if ($adm == null) {
            return response()->json([
                'status' => false,
                'message' => 'Administrador não encontrado'
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $adm
        ]);
    }

    public function  pesquisaPorNomeAdm(Request $request)
    {
        $adm = Administrador::where('nome', 'like', '%' . $request->nome . '%')->get();
        if (count($adm) > 0) {
            return response()->json([
                'status' => true,
                'data' => $adm
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para pesquisa.'
        ]);
    }

    public function pesquisaPorCpfAdm(Request $request)
    {
        $adm = Administrador::where('cpf', 'like', '%' . $request->cpf . '%')->get();
        if (count($adm) > 0) {
            return response()->json([
                'status' => true,
                'data' => $adm
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa.'
        ]);
    }

    public function pesquisaPorCelularAdm(Request $request)
    {
        $adm = Administrador::where('celular', 'like', '%' . $request->celular . '%')->get();
        if (count($adm) > 0) {
            return response()->json([
                'status' => true,
                'data' => $adm
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa.'
        ]);
    }

    public function pesquisaPorEmailAdm(Request $request)
    {
        $adm = Administrador::where('email', 'like', '%' . $request->email . '%')->get();
        if (count($adm) > 0) {
            return response()->json([
                'status' => true,
                'data' => $adm
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa.'
        ]);
    }

    public function deletarAdm($id)
    {
        $adm = Administrador::find($id);

        if (!isset($adm)) {
            return response()->json([
                'status' => false,
                'message' => 'Administrador não encontrado'
            ]);
        }
        $adm->delete();
        return response()->json([
            'status' => true,
            'message' => 'Administrador excluído com sucesso'
        ]);
    }

    public function retornarTodosAdm()
    {
        $adm = Administrador::all();

        return response()->json([
            'status' => true,
            'data' => $adm
        ]);
    }

    public function atualizarAdm(UpdateAdmFormRequest $request)
    {
        $adm = Administrador::find($request->id);

        if (!isset($adm)) {
            return response()->json([
                'status' => false,
                'message' => 'Administrador não  encontrado'
            ]);
        }
        if (isset($request->nome)) {
            $adm->nome = $request->nome;
        }

        if (isset($request->email)) {
            $adm->email = $request->email;
        }

        if (isset($request->cpf)) {
            $adm->cpf = $request->cpf;
        }

        if (isset($request->celular)) {
            $adm->celular = $request->celular;
        }

        if (isset($request->senha)) {
            $adm->senha = $request->senha;
        }

        $adm->update();
        return response()->json([
            'status' => true,
            'message' => 'Administrador Atualizado'
        ]);
    }
}
