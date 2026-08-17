@extends('layouts.admin')
@section('title', 'Categorias')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-gray-800">Categorias</h1>
    <a href="{{ route('admin.categorias.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl shadow">Nova Categoria</a>
</div>

<div class="bg-white shadow-md rounded my-6 overflow-x-auto">
    <table class="min-w-full w-full table-auto">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-base leading-normal">
                <th class="py-3 px-6 text-left">ID</th>
                <th class="py-3 px-6 text-left">Nome</th>
                <th class="py-3 px-6 text-center">Ações</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-lg font-light">
            @forelse($categorias as $categoria)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $categoria->id }}</td>
                <td class="py-3 px-6 text-left">{{ $categoria->nome }}</td>
                <td class="py-3 px-6 text-center">
                    <div class="flex item-center justify-center space-x-2">
                        <a href="{{ route('admin.categorias.edit', $categoria) }}" class="text-blue-500 bg-blue-200 hover:bg-blue-300 rounded-md py-1 px-1">Editar</a>
                        <form action="{{ route('admin.categorias.destroy', $categoria) }}" method="POST" onsubmit="return confirm('Tem certeza?');" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="abrirModal(this.closest('form'))" class="text-red-500 bg-red-200 hover:bg-red-300 rounded-md py-1 px-1">Excluir</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="py-3 px-6 text-center text-gray-500">Nenhuma categoria encontrada.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>


@endsection
