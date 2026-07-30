@extends('layouts.admin')
@section('title', 'Editar Categoria')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.categorias.index') }}" class="text-indigo-600 hover:text-indigo-800">&larr; Voltar para Categorias</a>
</div>

<div class="bg-white p-6 rounded shadow-md max-w-lg">
    <h2 class="text-xl font-semibold mb-4 text-gray-800">Editar Categoria</h2>
    
    <form action="{{ route('admin.categorias.update', $categoria) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nome">Nome da Categoria</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nome" type="text" name="nome" value="{{ old('nome', $categoria->nome) }}" required>
        </div>
        <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Atualizar
        </button>
    </form>
</div>
@endsection
