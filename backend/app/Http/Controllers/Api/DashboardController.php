<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Movimentacao;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $totalProdutos = Produto::count();
        $entradasHoje = Movimentacao::where('tipo', 'entrada')->whereDate('created_at', $today)->sum('quantidade');
        $saidasHoje = Movimentacao::where('tipo', 'saida')->whereDate('created_at', $today)->sum('quantidade');

        $estoqueBaixo = Produto::with('categoria')
            ->whereColumn('estoque_atual', '<=', 'estoque_minimo')
            ->get();

        return response()->json([
            'total_produtos' => $totalProdutos,
            'entradas_hoje' => (int) $entradasHoje,
            'saidas_hoje' => (int) $saidasHoje,
            'estoque_baixo' => $estoqueBaixo
        ]);
    }
}
