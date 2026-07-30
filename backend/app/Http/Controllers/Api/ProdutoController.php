<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index()
    {
        return response()->json(Produto::with('categoria')->get());
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
