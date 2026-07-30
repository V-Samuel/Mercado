@extends('layouts.admin')
@section('title', 'Movimentações')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-gray-800">Movimentações</h1>
    <a href="{{ route('admin.movimentacoes.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">Nova Movimentação</a>
</div>

<div class="bg-white shadow-md rounded my-6 overflow-x-auto">
    <table class="min-w-full w-full table-auto">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Data</th>
                <th class="py-3 px-6 text-left">Produto</th>
                <th class="py-3 px-6 text-center">Tipo</th>
                <th class="py-3 px-6 text-center">Quantidade</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @forelse($movimentacoes as $movimentacao)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $movimentacao->created_at->format('d/m/Y H:i') }}</td>
                <td class="py-3 px-6 text-left">{{ $movimentacao->produto->nome ?? '-' }}</td>
                <td class="py-3 px-6 text-center">
                    @if($movimentacao->tipo === 'entrada')
                        <span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs">Entrada</span>
                    @else
                        <span class="bg-red-200 text-red-700 py-1 px-3 rounded-full text-xs">Saída</span>
                    @endif
                </td>
                <td class="py-3 px-6 text-center">{{ $movimentacao->quantidade }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="py-3 px-6 text-center text-gray-500">Nenhuma movimentação encontrada.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
