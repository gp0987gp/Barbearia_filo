<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormaPagamentoRequest;
use App\Http\Requests\FormaPagamentoUpdateRequest;
use App\Models\TipoDePagamento;
use Illuminate\Http\Request;

class TipoDePagamentoController extends Controller
{
    public function tipoPagamento(FormaPagamentoRequest $request)
    {
        $pagamento = TipoDePagamento::create([
            'tipoPagamento' => $request->tipoPagamento,
           
            
        ]);
        return response()->json([
            "sucess" => true,
            "message" => "Métodos de Pagamento Adicionado",
            "data" => $pagamento
        ], 200);
    }



    public function excluirPagamento($id)
    {
        $pagamento = TipoDePagamento::find($id);

        if (!isset($pagamento)) {
            return response()->json([
                'status' => false,
                'message' => "Pagamento não encontrado"
            ]);
        }
        $pagamento->delete();
        return response()->json([
            'status' => true,
            'message' => "Pagamento excluído com sucesso"
        ]);
    }

    public function updatePagamento(FormaPagamentoUpdateRequest $request)
    {
        $pagamento = TipoDePagamento::find($request->id);

        if (!isset($pagamento)) {
            return response()->json([
                'status' => false,
                'message' => 'Tipo de Pagamento não encontrado'
            ]);
        }

        if (isset($request->tipoPagamento)) {
            $pagamento->tipoPagamento = $request->tipoPagamento;
        }
        $pagamento->update();

        return response()->json([
            'status' => true,
            'message' => 'Tipo de Pagamento Atualizado'
        ]);
    }
    
    public function retornarTodos()
    {
        $pagamento = TipoDePagamento::all();
        return response()->json([
            'status' => true,
            'data' => $pagamento
        ]);
    }
}
