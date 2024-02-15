<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdministradorFormRequest;
use App\Http\Requests\ClienteFormRequest;
use App\Http\Requests\UpdateAdmFormRequest;
use App\Http\Requests\UpdateFormRequest;
use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{
    public function cadastroAdm(AdministradorFormRequest $request)
    {
        $adm = Administrador::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'cellphone' => $request->cellphone,
            'password' => $request->password
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
        $adm = Administrador::where('name', 'like', '%' . $request->name . '%')->get();
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
        $adm = Administrador::where('cellphone', 'like', '%' . $request->cellphone . '%')->get();
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

        if (count($adm) > 0) {
            return response()->json([
                'status' => true,
                'data' => $adm
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há nenhum Administrador cadastrado no sistema'
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
        if (isset($request->name)) {
            $adm->name = $request->name;
        }

        if (isset($request->email)) {
            $adm->email = $request->email;
        }

        if (isset($request->cpf)) {
            $adm->cpf = $request->cpf;
        }

        if (isset($request->cellphone)) {
            $adm->cellphone = $request->cellphone;
        }

        if (isset($request->password)) {
            $adm->password = $request->password;
        }

        $adm->update();
        return response()->json([
            'status' => true,
            'message' => 'Administrador Atualizado'
        ]);
    }

    public function store(AdministradorFormRequest $request)
    {
        try {
            $data = $request->all();

            $data['password'] = Hash::make($request->password);

            $response = Administrador::create($data)->createToken($request->server('HTTP_USER_AGENT'))->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Admin cadastrado com sucesso',
                'token' => $response
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            if (Auth::guard('admins')->attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {
                $user = Auth::guard('admins')->user();

                /** @var UserContract $user */

                $token = $user->createToken($request->server('HTTP_USER_AGENT', ['admins']))->plainTextToken;
                return response()->json([
                    'status' => true,
                    'message' => 'Login efetuado com sucesso',
                    'token' => $token
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Credenciais incorretas'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function verificaUsuarioLogado(Request $request)
    {
        return 'Logado';
    }
}
