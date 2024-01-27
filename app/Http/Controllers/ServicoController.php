<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicoFormRequest;
use App\Http\Requests\UpdateFormRequest;
use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function store(ServicoFormRequest $request){
        $servicos = Servico::create([
            'nome' => $request -> nome,
            'preco' => str_replace(',', '.',$request -> preco),
            'descricao' => $request -> descricao,
            'duracao' => $request -> duracao
        ]);
        return response()->json([
            "status" => true,
            "message" => "Serviço cadastrado com sucesso",
            "data" => $servicos
        ], 200);
    }

    public function pesquisarPorId($id){
        $servicos = Servico::find($id);
        if($servicos == null){
            return response()-> json([
                'status' => false,
                'data' => "Serviço não encontrado"
            ]);
        }
        return response()-> json([
            'status' => true,
            'data' => $servicos
        ]);
    }

    public function pesquisaPorNome(Request $request){
        $servicos = Servico::where('nome', 'like', '%'. $request->nome .'%')->get();

        if(count($servicos)> 0){

        return response()->json([
            'status' => true,
            'data' => $servicos 
        ]);       

    }
    return response()->json([
        'status' => false,
        'message' => 'Não há resultados para pesquisa.'

    ]);
}

public function excluir($id){
    $servicos = Servico::find($id);

    if(!isset($servicos)){
        return response() -> json([
            'status' => false,
            'message' => "Serviço não encontrado"
        ]);
    }

    $servicos->delete();
    return response() -> json([
        'status' => true,
        'message' => "Serviço excluído com sucesso"
    ]);
}

public function update(UpdateFormRequest $request){
    $servicos = Servico::find($request->id);

    if(!isset($servicos)){
        return response() ->json([
            'status' => false,
            'message' => "Usuário não encontrado"
        ]);
    }
    if(isset($request->nome)){
        $servicos->nome = $request-> nome;
    }

    if(isset($request->preco)){
        $servicos->preco = $request -> preco;
    }

    if(isset($request->descricao)){
        $servicos->descricao = $request->descricao;
    }

    if(isset($request->duracao)){
        $servicos->duracao = $request->duracao;
    }

    $servicos->update();
    return response()-> json([
        'status' => true,
        'message' => "Serviço atualizado"
    ]);
}

public function retornarTodos(){
    $servicos = Servico::all();

    return response()->json([
        'status' => true,
        'data' => $servicos
    ]);       
}

}
