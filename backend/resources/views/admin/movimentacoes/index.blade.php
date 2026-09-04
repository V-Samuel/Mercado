@extends('layouts.admin')
@section('title', 'Movimentações')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-gray-800">Movimentações</h1>
    <a href="{{ route('admin.movimentacoes.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl shadow">Nova Movimentação</a>
</div>

<div class="my-6">
    <table class="min-w-full w-full table-auto border-collapse rounded-2xl shadow-md overflow-hidden">
        <!-- CABEÇALHO: Oculto no celular, visível a partir de telas médias (md) -->
        <thead class="hidden md:table-header-group">
            <tr class="bg-gray-200 text-gray-600 uppercase text-base leading-normal">
                <th class="py-3 px-6 text-center">Data</th>
                <th class="py-3 px-6 text-center">Produto</th>
                <th class="py-3 px-6 text-center">Tipo</th>
                <th class="py-3 px-6 text-center">Quantidade</th>
            </tr>
        </thead>
        
        <!-- CORPO DA TABELA -->
        <tbody class="text-gray-600 text-lg font-light block md:table-row-group">
            
            @forelse($movimentacoes as $movimentacao)
            <!-- LINHA (TR): Vira um 'card' no celular -->
            <tr class="block md:table-row bg-white md:bg-transparent shadow-md md:shadow-none rounded-lg md:rounded-none mb-4 md:mb-0 border-b border-gray-200 hover:bg-gray-100 p-2 md:p-0">
                
                <!-- CÉLULAS (TD) -->
                <td class="py-2 px-4 md:py-3 md:px-6 text-left md:text-center flex items-start md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block w-28 shrink-0 font-bold text-gray-700 md:hidden">Data:</span>
                    <span class="flex-1">{{ $movimentacao->created_at->format('d/m/Y H:i') }}</span>
                </td>
                
                <td class="py-2 px-4 md:py-3 md:px-6 text-left md:text-center flex items-start md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block w-28 shrink-0 font-bold text-gray-700 md:hidden">Produto:</span>
                    <span class="flex-1">{{ $movimentacao->produto->nome ?? '-' }}</span>
                </td>
                
                <!-- Note o text-left md:text-center para alinhar à esquerda no celular, mas manter centralizado no desktop -->
                <td class="py-2 px-4 md:py-3 md:px-6 text-left md:text-center flex items-start md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block w-28 shrink-0 font-bold text-gray-700 md:hidden">Tipo:</span>
                    <span class="flex-1">
                        @if($movimentacao->tipo === 'entrada')
                            <span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-base">Entrada</span>
                        @else
                            <span class="bg-red-200 text-red-700 py-1 px-3 rounded-full text-base">Saída</span>
                        @endif
                    </span>
                </td>
                
                <td class="py-2 px-4 md:py-3 md:px-6 text-left md:text-center flex items-start md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block w-28 shrink-0 font-bold text-gray-700 md:hidden">Quantidade:</span>
                    <span class="flex-1">{{ $movimentacao->quantidade }}</span>
                </td>
            </tr>
            @empty
            <tr class="block md:table-row">
                <td colspan="4" class="py-3 px-6 text-center text-gray-500 block md:table-cell bg-white rounded-lg shadow-sm md:bg-transparent md:shadow-none">
                    Nenhuma movimentação encontrada.
                </td>
            </tr>
            @endforelse
            
        </tbody>
    </table>
</div>
@endsection
