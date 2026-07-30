@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white p-6 rounded shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <h2 class="text-gray-500 text-sm font-semibold uppercase tracking-wider">Total de Produtos</h2>
            <p class="text-3xl font-bold text-gray-800">{{ $produtosCount }}</p>
        </div>
        <div class="p-3 bg-indigo-100 rounded-full text-indigo-600">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
        </div>
    </div>
    
    <div class="bg-white p-6 rounded shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <h2 class="text-gray-500 text-sm font-semibold uppercase tracking-wider">Total de Categorias</h2>
            <p class="text-3xl font-bold text-gray-800">{{ $categoriasCount }}</p>
        </div>
        <div class="p-3 bg-green-100 rounded-full text-green-600">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
        </div>
    </div>
</div>
@endsection
