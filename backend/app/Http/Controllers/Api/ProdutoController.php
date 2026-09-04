<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $query = Produto::with('categoria');
        
        if ($request->has('sku')) {
            $query->where('sku', $request->query('sku'));
        }
        
        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'preco_custo' => 'required|numeric',
            'preco_venda' => 'required|numeric',
        ]);
        $produto = Produto::create($request->all());
        return response()->json($produto, 201);
    }

    public function show(Produto $produto)
    {
        return response()->json($produto->load('categoria'));
    }

    public function update(Request $request, Produto $produto)
    {
        $produto->update($request->all());
        return response()->json($produto);
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return response()->json(null, 204);
    }
}
