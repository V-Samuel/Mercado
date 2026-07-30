<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Movimentacao;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class MovimentacaoController extends Controller
{
    public function index()
    {
        return response()->json(Movimentacao::with(['produto', 'usuario'])->orderBy('created_at', 'desc')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'tipo' => 'required|in:entrada,saida',
            'quantidade' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $produto = Produto::lockForUpdate()->findOrFail($request->produto_id);

            // Validar saída
            if ($request->tipo === 'saida' && $produto->estoque_atual < $request->quantidade) {
                return response()->json(['message' => 'Estoque insuficiente'], 400);
            }

            // Criar movimentação
            $movimentacao = Movimentacao::create([
                'produto_id' => $request->produto_id,
                'tipo' => $request->tipo,
                'quantidade' => $request->quantidade,
                'usuario_id' => $request->user()->id,
                'motivo' => $request->motivo
            ]);

            // Atualizar estoque
            if ($request->tipo === 'entrada') {
                $produto->estoque_atual += $request->quantidade;
            } else {
                $produto->estoque_atual -= $request->quantidade;
            }
            $produto->save();

            DB::commit();

            return response()->json($movimentacao->load(['produto', 'usuario']), 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao registrar movimentação', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(Movimentacao $movimentacao)
    {
        return response()->json($movimentacao->load(['produto', 'usuario']));
    }
}
