@extends('layouts.admin')
@section('title', 'Categorias')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-gray-800">Categorias</h1>
    <a href="{{ route('admin.categorias.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl shadow">Nova Categoria</a>
</div>

<div class="my-6">
    <table class="min-w-full w-full table-auto border-collapse rounded-2xl shadow-md overflow-hidden">
        <thead class="hidden md:table-header-group">
            <tr class="bg-gray-200 text-gray-600 uppercase text-base leading-normal">
                <th class="py-3 px-6 text-left md:text-center">ID</th>
                <th class="py-3 px-6 text-left md:text-center">Nome</th>
                <th class="py-3 px-6 text-left md:text-center">Descrição</th>
                <th class="py-3 px-6 text-center">Ações</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-lg font-light block md:table-row-group">
            @forelse($categorias as $categoria)
            <tr class="block md:table-row bg-white md:bg-transparent shadow-md md:shadow-none rounded-lg md:rounded-none mb-4 md:mb-0 border-b border-gray-200 hover:bg-gray-100 p-2 md:p-0">
                <td class="py-2 px-4 md:py-3 md:px-6 text-left md:text-center flex items-start md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block w-28 shrink-0 font-bold text-gray-700 md:hidden">ID:</span>
                    <span class="flex-1">{{ $categoria->id }}</span>
                </td>
                <td class="py-2 px-4 md:py-3 md:px-6 text-left md:text-center flex items-start md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block w-28 shrink-0 font-bold text-gray-700 md:hidden">Nome:</span>
                    <span class="flex-1">{{ $categoria->nome }}</span>
                </td>
                <td class="py-2 px-4 md:py-3 md:px-6 text-left md:text-center flex items-start md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block w-28 shrink-0 font-bold text-gray-700 md:hidden">Descrição:</span>
                    <span class="flex-1">{{ $categoria->descricao ?? '-' }}</span>
                </td>
                <td class="py-3 px-4 md:px-6 text-left md:text-center flex items-center md:table-cell uppercase text-base">
                    <span class="inline-block w-28 shrink-0 font-bold text-gray-700 md:hidden">Ações:</span>
                    <div class="flex-1 inline-flex md:flex items-center justify-start md:justify-center space-x-2">
                        <x-button-edit href="{{ route('admin.categorias.edit', $categoria) }}" />
        
                        <x-button-delete action="{{ route('admin.categorias.destroy', $categoria) }}" />
                    </div>
                </td>
            </tr>
            @empty
            <tr class="block md:table-row">
                <td colspan="4" class="py-3 px-6 text-center text-gray-500 block md:table-cell bg-white rounded-lg shadow-sm md:bg-transparent md:shadow-none">
                    Nenhuma categoria encontrada.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>


@endsection
