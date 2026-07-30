@extends('layouts.admin')
@section('title', 'Produtos')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-gray-800">Produtos</h1>
    <a href="{{ route('admin.produtos.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">Novo Produto</a>
</div>

<div class="bg-white shadow-md rounded my-6 overflow-x-auto">
    <table class="min-w-full w-full table-auto">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">ID</th>
                <th class="py-3 px-6 text-left">Nome</th>
                <th class="py-3 px-6 text-left">Preço</th>
                <th class="py-3 px-6 text-left">Estoque</th>
                <th class="py-3 px-6 text-left">Categoria</th>
                <th class="py-3 px-6 text-center">Ações</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @forelse($produtos as $produto)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $produto->id }}</td>
                <td class="py-3 px-6 text-left">{{ $produto->nome }}</td>
                <td class="py-3 px-6 text-left">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                <td class="py-3 px-6 text-left">{{ $produto->quantidade_estoque }}</td>
                <td class="py-3 px-6 text-left">{{ $produto->categoria->nome ?? '-' }}</td>
                <td class="py-3 px-6 text-center">
                    <div class="flex item-center justify-center space-x-2">
                        <a href="{{ route('admin.produtos.edit', $produto) }}" class="text-blue-500 hover:text-blue-700">Editar</a>
                        <form action="{{ route('admin.produtos.destroy', $produto) }}" method="POST" onsubmit="return confirm('Tem certeza?');" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Excluir</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="py-3 px-6 text-center text-gray-500">Nenhum produto encontrado.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
