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
            'status' => $request->status
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
        if (isset($request->nome) && $request->nome !== $tipoDePagamento->nome) {
            $existingPayment = TipoDePagamento::where('nome', $request->nome)
                ->where(function ($query) use ($request) {
                    $query->where('id', '!=', $request->id)
                        ->orWhereNull('id');
                })->first();

            if ($existingPayment) {
                if ($existingPayment->id) {
                    return response()->json([
                        'status' => false,
                        'message' => 'O nome especificado já está em uso por outro tipo de pagamento'
                    ]);
                } else {
                    // Lidar com o caso em que o registro existente tem um ID nulo
                }
            }
            $tipoDePagamento->nome = $request->nome;
        }

        if (isset($request->nome)) {
            $tipoDePagamento->nome = $request->nome;
        }

        if (isset($request->taxa)) {
            $tipoDePagamento->taxa = $request->taxa;
        }

        if (isset($request->status)) {
            $tipoDePagamento->status = $request->status;
        }

        $tipoDePagamento->update();
        return response()->json([
            'status' => true,
            'message' => 'Pagamento atualizado com sucesso'
        ]);
    }

    public function visualizarCadastroTipoPagamentoHabilitado()
    {
        $pagamento = TipoDePagamento::where('status', 'habilitado')->get();
        if ($pagamento->count() > 0) {
            return response()->json([
                'status' => true,
                'data' => $pagamento
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há registros no sitema'
        ]);
    }

    public function visualizarCadastroTipoPagamentoDesabilitado()
    {
        $pagamento = TipoDePagamento::where('status', 'desabilitado')->get();
        if ($pagamento->count() > 0) {
            return response()->json([
                'status' => true,
                'data' => $pagamento
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há registros no sitema'
        ]);
    }

    public function retornarTodos()
    {
        $pagamento = TipoDePagamento::all();

        if (count($pagamento) > 0) {
            return response()->json([
                'status' => true,
                'data' => $pagamento
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há nenhum pagamento registrado no sistema'
        ]);
    }
}
