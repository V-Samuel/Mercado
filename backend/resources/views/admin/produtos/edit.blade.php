@extends('layouts.admin')
@section('title', 'Editar Produto')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.produtos.index') }}" class="text-indigo-600 hover:text-indigo-800">&larr; Voltar para Produtos</a>
</div>

<div class="bg-white p-6 rounded shadow-md max-w-lg">
    <h2 class="text-xl font-semibold mb-4 text-gray-800">Editar Produto</h2>
    
    <form action="{{ route('admin.produtos.update', $produto) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nome">Nome</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nome" type="text" name="nome" value="{{ old('nome', $produto->nome) }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="sku">Código de Barras/ SKU</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="sku" type="number" name="sku" value="{{ old('sku', $produto->sku) }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="preco_custo">Preço Custo</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="preco_custo" type="number" step="0.01" name="preco_custo" value="{{ old('preco_custo', $produto->preco_custo) }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="preco_venda">Preço Venda</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="preco_venda" type="number" step="0.01" name="preco_venda" value="{{ old('preco_venda', $produto->preco_venda) }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="estoque_atual">Estoque Atual</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="estoque_atual" type="number" name="estoque_atual" value="{{ old('estoque_atual', $produto->estoque_atual) }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="estoque_minimo">Estoque Mínimo</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="estoque_minimo" type="number" name="estoque_minimo" value="{{ old('estoque_minimo', $produto->estoque_minimo) }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="categoria_id">Categoria</label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="categoria_id" name="categoria_id" required>
                <option value="">Selecione...</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}" {{ old('categoria_id', $produto->categoria_id) == $cat->id ? 'selected' : '' }}>{{ $cat->nome }}</option>
                @endforeach
            </select>
        </div>
        <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Atualizar
        </button>
    </form>
</div>
@endsection
