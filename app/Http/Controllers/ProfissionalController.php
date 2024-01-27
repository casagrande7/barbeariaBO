<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfissionalFormRequest;
use App\Http\Requests\UpdateProfissionalFormRequest;
use App\Models\Agenda;
use App\Models\Profissional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfissionalController extends Controller
{
    public function store(ProfissionalFormRequest $request){
        $profissional= Profissional::create([
            'nome' => $request-> nome,
            'celular' => $request -> celular,
            'cpf' => $request -> cpf,
            'email' => $request -> email,
            'dataNascimento' => $request -> dataNascimento,
            'cidade' => $request -> cidade,
            'estado' => $request -> estado,
            'pais' => $request -> pais,
            'rua' => $request -> rua,
            'numero' => $request -> numero,
            'bairro' => $request -> bairro,
            'cep' => $request -> cep,
            'complemento' => $request -> complemento,
            'salario' => $request -> salario,
            'senha' => Hash::make($request->senha)

        ]);
        return response()->json([
            "status" => true,
            "message" => "Profissional cadastrado com sucesso",
            "data" => $profissional
        ], 200);
    }

    public function pesquisandoPorId($id){
        $profissional = Profissional::find($id);
        if($profissional == null){
            return response()-> json([
                'status' => false,
                'data' => "Profissional não encontrado"
            ]);
        }
        return response()-> json([
            'status' => true,
            'data' => $profissional
        ]);
    }

    public function pesquisandoPorNome(Request $request){
        $profissional = Profissional::where('nome', 'like', '%'. $request->nome .'%')->get();

        if(count($profissional)> 0){

        return response()->json([
            'status' => true,
            'data' => $profissional 
        ]);       

    }
    return response()->json([
        'status' => false,
        'message' => 'Não há resultados para pesquisa.'

    ]);
}

public function pesquisandoPorCpf(Request $request){
    $profissional = Profissional::where('cpf', 'like', '%'. $request->cpf .'%')->get();

    if(count($profissional)> 0){

    return response()->json([
        'status' => true,
        'data' => $profissional
    ]);       

}
return response()->json([
    'status' => false,
    'message' => 'Não há resultados para pesquisa.'

]);
}

public function pesquisandoPorEmail(Request $request){
    $profissional = Profissional::where('email', 'like', '%'. $request->email .'%')->get();

    if(count($profissional)> 0){

    return response()->json([
        'status' => true,
        'data' => $profissional
    ]);       

}
return response()->json([
    'status' => false,
    'message' => 'Não há resultados para pesquisa.'

]);
}

public function pesquisandoPorCelular(Request $request){
    $profissional = Profissional::where('celular', 'like', '%'. $request->celular .'%')->get();

    if(count($profissional)> 0){

    return response()->json([
        'status' => true,
        'data' => $profissional
    ]);       

}
return response()->json([
    'status' => false,
    'message' => 'Não há resultados para pesquisa.'

]);
}

public function retornandoTodosProfissionais(){
    $profissional = Profissional::all();

    return response()->json([
        'status' => true,
        'data' => $profissional
    ]);       
}
   
public function atualizarProfissional(UpdateProfissionalFormRequest $request){
    $profissional = Profissional::find($request->id);

    if(!isset($profissional)){
        return response() ->json([
            'status' => false,
            'message' => "Profissional não encontrado"
        ]);
    }
    if(isset($request->nome)){
        $profissional->nome = $request-> nome;
    }

    if(isset($request->cpf)){
        $profissional->cpf = $request -> cpf;
    }

    if(isset($request->cep)){
        $profissional->cep = $request->cep;
    }

    if(isset($request->email)){
        $profissional->email = $request->email;
    }

    if(isset($request->celular)){
        $profissional->celular = $request->celular;
    }

    if(isset($request->bairro)){
        $profissional->bairro = $request->bairro;
    }

    if(isset($request->rua)){
        $profissional->rua = $request->rua;
    }

    if(isset($request->numero)){
        $profissional->numero = $request->numero;
    }

    if(isset($request->pais)){
        $profissional->pais = $request->pais;
    }

    if(isset($request->complemento)){
        $profissional->complemento = $request->complemento;
    }

    if(isset($request->cidade)){
        $profissional->cidade = $request->cidade;
    }

    if(isset($request->estado)){
        $profissional->estado = $request->estado;
    }

    if(isset($request->senha)){
        $profissional->senha = $request->senha;
    }

    if(isset($request->dataNascimento)){
        $profissional->dataNascimento = $request->dataNascimento;
    }

    if(isset($request->salario)){
        $profissional->salario = $request->salario;
    }

    $profissional->update();
    return response()-> json([
        'status' => true,
        'message' => "Profissional atualizado"
    ]);
}

public function deletarProfissional($id){
    $profissional = Profissional::find($id);

    if(!isset($profissional)){
        return response() -> json([
            'status' => false,
            'message' => "Profissional não encontrado"
        ]);
    }
    $profissional_agendamento = Agenda::where('profissional_id', $id)->get();
    if(count($profissional_agendamento) > 0){
        return response()->json([
        'status' => false,
        'message' => "Não foi possível excluir, pois o profissional possui agendamentos registrados."
        ]);
    }

    $profissional->delete();
    return response() -> json([
        'status' => true,
        'message' => "Profissional excluído com sucesso"
    ]);
}

public function redefinirSenha(Request $request)
    {
        $profissional = Profissional::where('email', 'LIKE', $request->email)->first();
        if ($profissional) {
            $novaSenha = $profissional->cpf;
            $profissional->update([
                'senha' => Hash::make
                ($novaSenha),
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

}
