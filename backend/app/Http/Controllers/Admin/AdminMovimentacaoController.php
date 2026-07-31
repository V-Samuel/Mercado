<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movimentacao;
use App\Models\Produto;
use Illuminate\Http\Request;

class AdminMovimentacaoController extends Controller
{
    public function index()
    {
        $movimentacoes = Movimentacao::with('produto')->latest()->get();
        return view('admin.movimentacoes.index', compact('movimentacoes'));
    }

    public function create()
    {
        $produtos = Produto::all();
        return view('admin.movimentacoes.create', compact('produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'tipo' => 'required|in:entrada,saida',
            'quantidade' => 'required|integer|min:1'
        ]);

        $produto = Produto::findOrFail($request->produto_id);

        if ($request->tipo === 'saida' && $produto->estoque_atual < $request->quantidade) {
            return back()->withErrors(['quantidade' => 'Estoque insuficiente para esta saída.'])->withInput();
        }

        $data = $request->all();
        $data['usuario_id'] = auth()->id();
        Movimentacao::create($data);

        if ($request->tipo === 'entrada') {
            $produto->increment('estoque_atual', $request->quantidade);
        } else {
            $produto->decrement('estoque_atual', $request->quantidade);
        }

        return redirect()->route('admin.movimentacoes.index')->with('success', 'Movimentação registrada com sucesso.');
    }
}
