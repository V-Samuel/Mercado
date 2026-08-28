<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Movimentacao;
use App\Models\Produto;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $produtosCount = Produto::count();
        $categoriasCount = Categoria::count();
        $movimentacoesCount = Movimentacao::count();
        $produtosAbaixoEstoqueMinimoCount = Produto::whereColumn('estoque_atual', '<', 'estoque_minimo')->count();
        $produtosAbaixoEstoqueMinimo = Produto::whereColumn('estoque_atual', '<', 'estoque_minimo')->pluck('nome')->implode(', ');
        $produtoMaisMovimentado = Movimentacao::select('produto_id')
            ->selectRaw('COUNT(*) as total_movimentacoes')
            ->groupBy('produto_id')
            ->orderByDesc('total_movimentacoes')
            ->with('produto')
            ->first()?->produto->nome ?? 'Nenhum produto movimentado';
        $topProdutosVendidos = Movimentacao::selectRaw('produto_id, SUM(quantidade) as total_vendido')
            ->where('tipo', 'saida')
            ->groupBy('produto_id')
            ->orderByDesc('total_vendido')
            ->limit(7)
            ->with('produto')
            ->get();

        $chartLabels = $topProdutosVendidos->pluck('produto.nome')->toArray();
        $chartData = $topProdutosVendidos->pluck('total_vendido')->toArray();
        $produtosPertoDeVencerCount = Produto::where('data_validade', '<=', now()->addDays(30))->count();
        $diasProdutosPertoDeVencer = Produto::where('data_validade', '<=', now()->addDays(30))
        ->get()
        ->map(function ($produto) {

            $dias = now()->startOfDay()->diffInDays($produto->data_validade, false); 
        
            $dias = (int) $dias;

            if ($dias < 0) {
                
            $diasPassados = abs($dias); 
            return "{$produto->nome} já venceu há {$diasPassados} dias!";
            }

            if ($dias === 1) {
                return "{$produto->nome} falta 1 dia para vencer!";
            }

            if ($dias === 0) {
                return "{$produto->nome} vence hoje!";
            }
        
            return "{$produto->nome} faltam {$dias} dias para vencer"; 
        })
        ->toArray();

        return view('admin.dashboard', compact(
            'produtosCount', 
            'categoriasCount', 
            'movimentacoesCount', 
            'produtosAbaixoEstoqueMinimoCount', 
            'produtosAbaixoEstoqueMinimo', 
            'produtoMaisMovimentado',
            'chartLabels',
            'chartData',
            'produtosPertoDeVencerCount',
            'diasProdutosPertoDeVencer'
        ));
    }
}
