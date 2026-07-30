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
            <label class="block text-gray-700 text-sm font-bold mb-2" for="preco">Preço</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="preco" type="number" step="0.01" name="preco" value="{{ old('preco', $produto->preco) }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="quantidade_estoque">Estoque</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="quantidade_estoque" type="number" name="quantidade_estoque" value="{{ old('quantidade_estoque', $produto->quantidade_estoque) }}" required>
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
