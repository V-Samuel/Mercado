@extends('layouts.admin')

@section('title', 'Gerenciar Equipe')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Equipe</h2>
        
    </div>
    <button onclick="document.getElementById('modalNovaEquipe').classList.remove('hidden')" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
        + Novo Membro
    </button>
</div>

<!-- Tabela de Membros -->

    <div class="my-6">
    <p class="text-gray-600 text-sm mb-4 md:mb-6">Gerencie os membros da sua equipe que terão acesso compartilhado aos dados.</p>
    <table class="min-w-full w-full table-auto border-collapse rounded-2xl shadow-md overflow-hidden bg-white">
        <!-- CABEÇALHO: Oculto no celular, visível a partir de telas médias (md) -->
        <thead class="hidden md:table-header-group">
            <tr class="bg-gray-200 text-gray-600 uppercase text-base leading-normal">
                <th class="py-3 px-6 text-left md:text-center font-semibold">Nome</th>
                <th class="py-3 px-6 text-left md:text-center font-semibold">E-mail</th>
                <th class="py-3 px-6 text-left md:text-center font-semibold">Perfil</th>
                <th class="py-3 px-6 text-left md:text-center font-semibold">Data de Criação</th>
                <th class="py-3 px-6 text-center font-semibold">Ações</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-base md:text-sm font-light block md:table-row-group">
                
                @forelse($equipe as $membro)
                    <tr class="block md:table-row shadow-md md:shadow-none rounded-lg md:rounded-none mb-4 md:mb-0 border-b border-gray-200 p-2 md:p-0 bg-white hover:bg-gray-50 transition-colors">
                        <td class="py-2 px-4 md:py-3 md:px-6 text-left md:text-center flex items-center md:table-cell border-b md:border-none border-gray-100">
                            <span class="inline-block text-left w-24 shrink-0 font-bold text-gray-700 md:hidden">Nome:</span>
                            <span class="flex-1">{{ $membro->name }}</span>
                        </td>
                        <td class="py-2 px-4 md:py-3 md:px-6 text-left md:text-center flex items-center md:table-cell border-b md:border-none border-gray-100">
                            <span class="inline-block text-left w-24 shrink-0 font-bold text-gray-700 md:hidden">E-mail:</span>
                            <span class="flex-1">{{ $membro->email }}</span>
                        </td>
                        <td class="py-2 px-4 md:py-3 md:px-6 text-left md:text-center flex items-center md:table-cell border-b md:border-none border-gray-100">
                            <span class="inline-block text-left w-24 shrink-0 font-bold text-gray-700 md:hidden">Perfil:</span>
                            <span class="flex-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $membro->nivel_acesso === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($membro->nivel_acesso) }}
                                </span>
                            </span>
                        </td>
                        <td class="py-2 px-4 md:py-3 md:px-6 text-left md:text-center flex items-center md:table-cell border-b md:border-none border-gray-100">
                            <span class="inline-block text-left w-24 shrink-0 font-bold text-gray-700 md:hidden">Criação:</span>
                            <span class="flex-1">{{ $membro->created_at->format('d/m/Y H:i') }}</span>
                        </td>
                        <td class="py-3 px-4 md:px-6 text-left md:text-center flex items-center md:table-cell uppercase text-base">
                            <span class="inline-block text-left w-24 shrink-0 font-bold text-gray-700 md:hidden">Ações:</span>
                            <div class="flex-1 inline-flex md:flex items-center justify-start md:justify-center">
                                <form action="{{ route('admin.equipe.destroy', $membro->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja remover este membro da equipe?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="abrirModal(this.closest('form'))" class="text-red-500 hover:text-red-700 transition-colors" title="Remover">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="block md:table-row">
                        <td colspan="5" class="py-6 px-4 text-center text-gray-500 block md:table-cell bg-white rounded-lg shadow-sm">
                            Nenhum membro na equipe ainda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
</div>

<!-- Modal Novo Membro -->
<div id="modalNovaEquipe" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Adicionar Novo Membro</h3>
            <button type="button" onclick="document.getElementById('modalNovaEquipe').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="px-6 py-4">
            <form action="{{ route('admin.equipe.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                    <input type="text" name="name" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                    <input type="email" name="email" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                    <input type="password" name="password" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border"  required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar Senha</label>
                    <input type="password" name="password_confirmation" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border" required>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Perfil de Acesso</label>
                    <select name="nivel_acesso" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border" required>
                        <option value="operador">Operador</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('modalNovaEquipe').classList.add('hidden')" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
