@extends('layouts.admin')
@section('title', 'Produtos')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-gray-800">Produtos</h1>
    <a href="{{ route('admin.produtos.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl shadow">Novo Produto</a>
</div>


<div class="mx-auto md:mx-0 mt-6 bg-gray-50 p-4 rounded-2xl shadow-md border border-gray-200 max-w-sm">
    <p class="font-bold text-gray-700 mb-3">Legendas de Atenção:</p>

    <ul class="flex flex-col gap-2">
        <li class="flex items-center gap-2">
            <span class="block w-5 h-5 bg-red-300 rounded border border-red-400"></span>
            <span class="text-gray-700 text-sm">Estoque abaixo do mínimo</span>
        </li>
        
        <li class="flex items-center gap-2">
            <span class="block w-5 h-5 bg-purple-200 rounded border border-purple-300"></span>
            <span class="text-gray-700 text-sm">Produto com validade próxima (30 dias)</span>
        </li>
        
        <li class="flex items-center gap-2">
            <span class="block w-5 h-5 bg-[#f799b8] rounded border border-[#f55d90]"></span>
            <span class="text-gray-700 text-sm">Estoque abaixo do mínimo e validade próxima</span>
        </li>
    </ul>

</div>

<div class="my-6">
    <table class="min-w-full w-full table-auto border-collapse rounded-2xl shadow-md overflow-hidden">
        <!-- CABEÇALHO: Oculto no celular, visível a partir de telas médias (md) -->
        <thead class="hidden md:table-header-group">
            <tr class="bg-gray-200 text-gray-600 uppercase text-base leading-normal">
                <th class="py-3 px-6 text-left md:text-center">ID</th>
                <th class="py-3 px-2 text-left md:text-center">Nome</th>
                <th class="py-3 px-2 text-left md:text-center">Unidade de Medida</th>
                <th class="py-3 px-2 text-left md:text-center">SKU</th>
                <th class="py-3 px-2 text-left md:text-center">Data de Validade</th>
                <th class="py-3 px-6 text-left md:text-center">Custo</th>
                <th class="py-3 px-6 text-left md:text-center">Venda</th>
                <th class="py-3 px-6 text-left md:text-center">Estoque</th>
                <th class="py-3 px-6 text-left md:text-center">Mínimo</th>
                <th class="py-3 px-6 text-left md:text-center">Categoria</th>
                <th class="py-3 px-6 text-center">Ações</th>
            </tr>
        </thead>
        
        <!-- CORPO DA TABELA -->
        <tbody class="text-gray-600 text-lg font-light block md:table-row-group">
            
            @forelse($produtos as $produto)
            <!-- LINHA (TR): Vira um 'card' no celular (com margem inferior, fundo branco e sombra) -->
            <tr class="block md:table-row shadow-md md:shadow-none rounded-lg md:rounded-none mb-4 md:mb-0 border-b border-gray-200 p-2 md:p-0 {{$produto->estoque_atual < $produto->estoque_minimo && $produto->data_validade && $produto->data_validade <= now()->addDays(30) ?  'bg-[#f799b8] hover:bg-[#f8b0c8]' : ($produto->estoque_atual < $produto->estoque_minimo ? 'bg-red-300 hover:bg-red-200' : ( $produto->data_validade && $produto->data_validade <= now()->addDays(30) ? 'bg-purple-200 hover:bg-purple-100' : 'bg-white hover:bg-gray-200 md:bg-transparent' )  ) }}">
                     <!-- CÉLULAS (TD): Viram blocos empilhados no celular -->
                <td class="py-2 px-4 md:py-3 md:px-6 text-left md:text-center flex items-start md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block text-center w-24 shrink-0 font-bold text-gray-700 md:hidden">ID:</span>
                    <span class="flex-1">{{ $produto->id }}</span>
                </td>
                
                <td class="py-2 px-4 md:py-3 md:px-2 text-left md:text-center flex items-start md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block text-center w-24 shrink-0 font-bold text-gray-700 md:hidden">Nome:</span>
                    <span class="flex-1">{{ $produto->nome }}</span>
                </td>
                <td class="py-2 px-4 md:py-3 md:px-2 text-left md:text-center flex items-start md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block text-center w-24 shrink-0 font-bold text-gray-700 md:hidden">Unidade de Medida:</span>
                    <span class="flex-1">{{ number_format($produto->valor_unidade_medida, 2, ',', '.') }} {{ $produto->unidade_medida }}</span>
                </td>
                <td class="py-2 px-4 md:py-3 md:px-2 text-left md:text-center flex items-start md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block text-center w-24 shrink-0 font-bold text-gray-700 md:hidden">SKU:</span>
                    <span class="flex-1">{{ $produto->sku }}</span>
                </td>
                <td class="py-2 px-4 md:py-3 md:px-6 text-left md:text-center flex items-start md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block text-center w-24 shrink-0 font-bold text-gray-700 md:hidden">Data de Validade:</span>
                    <span class="flex-1">{{ $produto->data_validade?->format('d/m/Y') ?? '-' }}</span>
                </td>
                <td class="py-2 px-4 md:py-3 md:px-6 text-left md:text-center flex items-start md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block text-center w-24 shrink-0 font-bold text-gray-700 md:hidden">Custo:</span>
                    <span class="flex-1">R$ {{ number_format($produto->preco_custo, 2, ',', '.') }}</span>
                </td>
                
                <td class="py-2 px-4 md:py-3 md:px-6 text-left md:text-center flex items-start md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block text-center w-24 shrink-0 font-bold text-gray-700 md:hidden">Venda:</span>
                    <span class="flex-1">R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</span>
                </td>
                
                <td class="py-2 px-4 md:py-3 md:px-6 text-left md:text-center flex items-start md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block text-center w-24 shrink-0 font-bold text-gray-700 md:hidden">Estoque:</span>
                    <span class="flex-1">{{ $produto->estoque_atual }}</span>
                </td>
                
                <td class="py-2 px-4 md:py-3 md:px-6 text-left md:text-center flex items-start md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block text-center w-24 shrink-0 font-bold text-gray-700 md:hidden">Mínimo:</span>
                    <span class="flex-1">{{ $produto->estoque_minimo }}</span>
                </td>
                
                <td class="py-2 px-4 md:py-3 md:px-6 text-left md:text-center flex items-start md:table-cell border-b md:border-none border-gray-100">
                    <span class="inline-block text-center w-24 shrink-0 font-bold text-gray-700 md:hidden">Categoria:</span>
                    <span class="flex-1">{{ $produto->categoria->nome ?? '-' }}</span>
                </td>
                
                <td class="py-3 px-4 md:px-6 text-left md:text-center flex items-center md:table-cell uppercase text-base">
                    <span class="inline-block text-center w-24 shrink-0 font-bold text-gray-700 md:hidden">Ações:</span>
    
                    <div class="flex-1 inline-flex md:flex items-center justify-start md:justify-center space-x-2">
        
                        <x-button-edit href="{{ route('admin.produtos.edit', $produto) }}" />
        
                        <x-button-delete action="{{ route('admin.produtos.destroy', $produto) }}" />
                    </div>
                </td>           </td>
            </tr>
            @empty
            <tr class="block md:table-row">
                <td colspan="11" class="py-3 px-6 text-center text-gray-500 block md:table-cell bg-white rounded-lg shadow-sm">
                    Nenhum produto encontrado.
                </td>
            </tr>

            @endforelse
            
        </tbody>
    </table>
</div>


@endsection
