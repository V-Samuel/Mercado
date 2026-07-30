<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class AdminProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('categoria')->get();
        return view('admin.produtos.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.produtos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'preco' => 'required|numeric',
            'quantidade_estoque' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id'
        ]);
        Produto::create($request->all());
        return redirect()->route('admin.produtos.index')->with('success', 'Produto criado com sucesso.');
    }

    public function edit(Produto $produto)
    {
        $categorias = Categoria::all();
        return view('admin.produtos.edit', compact('produto', 'categorias'));
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome' => 'required|string',
            'preco' => 'required|numeric',
            'quantidade_estoque' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id'
        ]);
        $produto->update($request->all());
        return redirect()->route('admin.produtos.index')->with('success', 'Produto atualizado com sucesso.');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('admin.produtos.index')->with('success', 'Produto excluído com sucesso.');
    }
}
