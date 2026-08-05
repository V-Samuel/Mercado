@extends('layouts.admin')
@section('title', 'Produtos')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-gray-800">Produtos</h1>
    <a href="{{ route('admin.produtos.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl shadow">Novo Produto</a>
</div>

<div class="my-6">
    <table class="min-w-full w-full table-auto border-collapse">
        <!-- CABEÇALHO: Oculto no celular, visível a partir de telas médias (md) -->
        <thead class="hidden md:table-header-group">
            <tr class="bg-gray-200 text-gray-600 uppercase text-base leading-normal">
                <th class="py-3 px-6 text-center">ID</th>
                <th class="py-3 px-6 text-center">Nome</th>
                <th class="py-3 px-6 text-center">Unidade de Medida</th>
                <th class="py-3 px-6 text-center">SKU</th>
                <th class="py-3 px-6 text-center">Custo</th>
                <th class="py-3 px-6 text-center">Venda</th>
                <th class="py-3 px-6 text-center">Estoque</th>
                <th class="py-3 px-6 text-center">Mínimo</th>
                <th class="py-3 px-6 text-center">Categoria</th>
                <th class="py-3 px-6 text-center">Ações</th>
            </tr>
        </thead>
        
        <!-- CORPO DA TABELA -->
        <tbody class="text-gray-600 text-lg font-light block md:table-row-group">
            
            @forelse($produtos as $produto)
            <!-- LINHA (TR): Vira um 'card' no celular (com margem inferior, fundo branco e sombra) -->
            <tr class="block md:table-row shadow-md md:shadow-none rounded-lg md:rounded-none mb-4 md:mb-0 border-b border-gray-200 p-2 md:p-0 {{ $produto->estoque_atual < $produto->estoque_minimo ? 'bg-red-200 hover:bg-red-100' : 'bg-white md:bg-transparent' }}">
                
                <!-- CÉLULAS (TD): Viram blocos empilhados no celular -->
                <td  class="py-2 px-4 md:py-3 md:px-6 text-center block md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block w-24 font-bold text-gray-700 md:hidden">ID:</span>
                    {{ $produto->id }}
                </td>
                
                <td class="py-2 px-4 md:py-3 md:px-6 text-center block md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block w-24 font-bold text-gray-700 md:hidden">Nome:</span>
                    {{ $produto->nome }}
                </td>
                <td class="py-2 px-4 md:py-3 md:px-6 text-center block md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block w-24 font-bold text-gray-700 md:hidden">Unidade de Medida:</span>
                    {{ number_format($produto->valor_unidade_medida, 2, ',', '.') }} {{ $produto->unidade_medida }}
                </td>
                <td class="py-2 px-4 md:py-3 md:px-6 text-center block md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block w-24 font-bold text-gray-700 md:hidden">SKU:</span>
                    {{ $produto->sku }}
                </td>
                
                <td class="py-2 px-4 md:py-3 md:px-6 text-center block md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block w-24 font-bold text-gray-700 md:hidden">Custo:</span>
                    R$ {{ number_format($produto->preco_custo, 2, ',', '.') }}
                </td>
                
                <td class="py-2 px-4 md:py-3 md:px-6 text-center block md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block w-24 font-bold text-gray-700 md:hidden">Venda:</span>
                    R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}
                </td>
                
                <td class="py-2 px-4 md:py-3 md:px-6 text-center block md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block w-24 font-bold text-gray-700 md:hidden">Estoque:</span>
                    {{ $produto->estoque_atual }}
                </td>
                
                <td class="py-2 px-4 md:py-3 md:px-6 text-center block md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block w-24 font-bold text-gray-700 md:hidden">Mínimo:</span>
                    {{ $produto->estoque_minimo }}
                </td>
                
                <td class="py-2 px-4 md:py-3 md:px-6 text-center block md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block w-24 font-bold text-gray-700 md:hidden">Categoria:</span>
                    {{ $produto->categoria->nome ?? '-' }}
                </td>
                
                <td class="py-3 px-4 md:px-6 text-left md:text-center block md:table-cell">
                    <span class="inline-block w-24 font-bold text-gray-700 md:hidden">Ações:</span>
                    <!-- Ajustado para alinhar à esquerda no mobile e centralizar no desktop -->
                    <div class="inline-flex md:flex items-center justify-start md:justify-center space-x-2">
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
            <tr class="block md:table-row">
                <td colspan="10" class="py-3 px-6 text-center text-gray-500 block md:table-cell bg-white rounded-lg shadow-sm">
                    Nenhum produto encontrado.
                </td>
            </tr>

            @endforelse
            
        </tbody>
    </table>
</div>
@endsection
