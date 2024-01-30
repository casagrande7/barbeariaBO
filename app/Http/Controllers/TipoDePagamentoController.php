<?php

namespace App\Http\Controllers;

use App\Http\Requests\PagamentoFormRequest;
use App\Http\Requests\UpdatePagamentoFormRequest;
use App\Models\TipoDePagamento;
use Illuminate\Http\Request;

class TipoDePagamentoController extends Controller
{
    public function tipoDePagamento(PagamentoFormRequest $request)
    {
        $tipoDePagamento = TipoDePagamento::create([
            'nome' => $request->nome,
            'taxa' => $request->taxa,
            'condicao' => $request->condicao
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Pagamento realizado com sucesso',
            'data' => $tipoDePagamento
        ]);
    }

    public function pesquisaPorPagamento(Request $request)
    {
        $tipoDePagamento = TipoDePagamento::where('nome', 'like', '%' . $request->nome . '%')->get();
        if (count($tipoDePagamento) > 0) {
            return response()->json([
                'status' => true,
                'data' => $tipoDePagamento
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa.'
        ]);
    }

    public function deletarPagamento($id)
    {
        $tipoDePagamento = TipoDePagamento::find($id);
        if (!isset($tipoDePagamento)) {
            return response()->json([
                'status' => false,
                'message' => 'Pagamento não encontrado'
            ]);
        }
        $tipoDePagamento->delete();
        return response()->json([
            'status' => true,
            'message' => 'Pagamento excluído com sucesso'
        ]);
    }

    public function atualizarPagamento(UpdatePagamentoFormRequest $request)
    {
        $tipoDePagamento = TipoDePagamento::find($request->id);

        if (!isset($tipoDePagamento)) {
            return response()->json([
                'status' => false,
                'message' => 'Pagamento não encontrado'
            ]);
        }

        if (isset($request->nome)) {
            $tipoDePagamento->nome = $request->nome;
        }

        if (isset($request->taxa)) {
            $tipoDePagamento->taxa = $request->taxa;
        }

        if (isset($request->condicao)) {
            $tipoDePagamento->condicao = $request->condicao;
        }

        $tipoDePagamento->update();
        return response()->json([
            'status' => true,
            'message' => 'Pagamento atualizado com sucesso'
        ]);
    }
}
