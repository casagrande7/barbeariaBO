<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteFormRequest;
use App\Http\Requests\UpdateClienteFormRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function store(ClienteFormRequest $request)
    {
        $clientes = Cliente::create([
            'nome' => $request->nome,
            'celular' => $request->celular,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'dataNascimento' => $request->dataNascimento,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'pais' => $request->pais,
            'rua' => $request->rua,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cep' => $request->cep,
            'complemento' => $request->complemento,
            'senha' => $request->senha

        ]);
        return response()->json([
            "status" => true,
            "message" => "Cliente cadastrado com sucesso",
            "data" => $clientes
        ], 200);
    }

    public function pesquisaPorId($id)
    {
        $clientes = Cliente::find($id);
        if ($clientes == null) {
            return response()->json([
                'status' => false,
                'data' => "Cliente não encontrado"
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $clientes
        ]);
    }

    public function pesquisarPorNome(Request $request)
    {
        $clientes = Cliente::where('nome', 'like', '%' . $request->nome . '%')->get();

        if (count($clientes) > 0) {

            return response()->json([
                'status' => true,
                'data' => $clientes
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para pesquisa.'

        ]);
    }

    public function pesquisarPorCpf(Request $request)
    {
        $clientes = Cliente::where('cpf', 'like', '%' . $request->cpf . '%')->get();

        if (count($clientes) > 0) {

            return response()->json([
                'status' => true,
                'data' => $clientes
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para pesquisa.'

        ]);
    }



    public function pesquisarPorEmail(Request $request)
    {
        $clientes = Cliente::where('email', 'like', '%' . $request->email . '%')->get();

        if (count($clientes) > 0) {

            return response()->json([
                'status' => true,
                'data' => $clientes
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para pesquisa.'

        ]);
    }

    public function pesquisarPorCelular(Request $request)
    {
        $clientes = Cliente::where('celular', 'like', '%' . $request->celular . '%')->get();

        if (count($clientes) > 0) {

            return response()->json([
                'status' => true,
                'data' => $clientes
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para pesquisa.'

        ]);
    }

    public function retornarTodosClientes()
    {
        $clientes = Cliente::all();

        if (count($clientes) > 0) {
            return response()->json([
                'status' => true,
                'data' => $clientes
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Não há nenhum clientes registrado no sistema'
        ]);
    }

    public function atualizarClientes(UpdateClienteFormRequest $request)
    {
        $clientes = Cliente::find($request->id);

        if (!isset($clientes)) {
            return response()->json([
                'status' => false,
                'message' => "Cliente não encontrado"
            ]);
        }
        if (isset($request->nome)) {
            $clientes->nome = $request->nome;
        }

        if (isset($request->cpf)) {
            $clientes->cpf = $request->cpf;
        }

        if (isset($request->cep)) {
            $clientes->cep = $request->cep;
        }

        if (isset($request->email)) {
            $clientes->email = $request->email;
        }

        if (isset($request->celular)) {
            $clientes->celular = $request->celular;
        }

        if (isset($request->bairro)) {
            $clientes->bairro = $request->bairro;
        }

        if (isset($request->rua)) {
            $clientes->rua = $request->rua;
        }

        if (isset($request->numero)) {
            $clientes->numero = $request->numero;
        }

        if (isset($request->pais)) {
            $clientes->pais = $request->pais;
        }

        if (isset($request->complemento)) {
            $clientes->complemento = $request->complemento;
        }

        if (isset($request->cidade)) {
            $clientes->cidade = $request->cidade;
        }

        if (isset($request->estado)) {
            $clientes->estado = $request->estado;
        }

        if (isset($request->senha)) {
            $clientes->senha = $request->senha;
        }

        if (isset($request->dataNascimento)) {
            $clientes->dataNascimento = $request->dataNascimento;
        }

        $clientes->update();
        return response()->json([
            'status' => true,
            'message' => "Cliente atualizado"
        ]);
    }


    public function excluirCliente($id)
    {
        $clientes = Cliente::find($id);

        if (!isset($clientes)) {
            return response()->json([
                'status' => false,
                'message' => "Cliente não encontrado"
            ]);
        }

        $clientes->delete();
        return response()->json([
            'status' => true,
            'message' => "Cliente excluído com sucesso"
        ]);
    }

    public function recuperarSenha(Request $request)
    {
        $clientes = Cliente::where('email', 'LIKE', $request->email)->first();
        if ($clientes) {
            $novaSenha = $clientes->cpf;
            $clientes->update([
                'senha' => Hash::make($novaSenha),
                'updated_at' => now()
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Senha redefinida',
                'nova_senha' => Hash::make($novaSenha)
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Cliente não encontrado'
            ]);
        }
    }

    public function cadastroLogin(ClienteFormRequest $request)
    {
        try {
            $data = $request->all();

            $data['senha'] = Hash::make($request->senha);

            $response = Cliente::create($data)->createToken($request->server('HTTP_USER_AGENT'))->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Cliente cadastrado com sucesso',
                'token' => $response
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function loginClientes(Request $request)
    {
        try {
            if (Auth::guard('clientes')->attempt([
                'email' => $request->email,
                'senha' => $request->senha
            ])) {
                $user = Auth::guard('clientes')->user();

                /** @var UserContract $user */

                $token = $user->createToken($request->server('HTTP_USER_AGENT', ['clientes']))->plainTextToken;
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
}
