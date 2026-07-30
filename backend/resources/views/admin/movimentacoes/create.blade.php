@extends('layouts.admin')
@section('title', 'Nova Movimentação')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.movimentacoes.index') }}" class="text-indigo-600 hover:text-indigo-800">&larr; Voltar para Movimentações</a>
</div>

<div class="bg-white p-6 rounded shadow-md max-w-lg">
    <h2 class="text-xl font-semibold mb-4 text-gray-800">Nova Movimentação</h2>
    
    <form action="{{ route('admin.movimentacoes.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="produto_id">Produto</label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="produto_id" name="produto_id" required>
                <option value="">Selecione...</option>
                @foreach($produtos as $produto)
                    <option value="{{ $produto->id }}" {{ old('produto_id') == $produto->id ? 'selected' : '' }}>{{ $produto->nome }} (Estoque: {{ $produto->quantidade_estoque }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="tipo">Tipo</label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tipo" name="tipo" required>
                <option value="entrada" {{ old('tipo') == 'entrada' ? 'selected' : '' }}>Entrada</option>
                <option value="saida" {{ old('tipo') == 'saida' ? 'selected' : '' }}>Saída</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="quantidade">Quantidade</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="quantidade" type="number" name="quantidade" min="1" value="{{ old('quantidade') }}" required>
        </div>
        <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Registrar
        </button>
    </form>
</div>
@endsection
