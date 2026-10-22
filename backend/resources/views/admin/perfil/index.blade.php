@extends('layouts.admin')

@section('title', 'Meu Perfil')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Meu Perfil</h2>
        <p class="text-gray-600 text-sm mt-1">Gerencie suas informações pessoais e credenciais de acesso.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden max-w-xl m-auto">
        <div class="p-6">
            <form action="{{ route('admin.perfil.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome Completo</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border"
                        required {{ $user->isDemo() ? 'disabled' : '' }}>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border"
                        required {{ $user->isDemo() ? 'disabled' : '' }}>
                </div>

                <div class="border-t border-gray-200 my-6 pt-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Alterar Senha</h3>
                    <p class="text-sm text-gray-500 mb-4">Deixe os campos abaixo em branco se não quiser alterar sua senha.
                    </p>

                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nova Senha</label>
                        <input type="password" name="password"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border"
                            {{ $user->isDemo() ? 'disabled' : '' }}>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar Nova Senha</label>
                        <input type="password" name="password_confirmation"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border"
                            {{ $user->isDemo() ? 'disabled' : '' }}>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-lg transition-colors {{ $user->isDemo() ? 'opacity-50 cursor-not-allowed' : '' }}"
                        {{ $user->isDemo() ? 'disabled' : '' }}>
                        Salvar Alterações
                    </button>
                </div>
            </form>
            @if (!is_null($user->parent_id) && !$user->isDemo())
                <div class="mt-8 bg-red-50 rounded-xl border border-red-200 overflow-hidden max-w-3xl">
                    <div class="p-6 text-center">
                        <button onclick="document.getElementById('modalDeleteConta').classList.remove('hidden'); document.getElementById('modalDeleteConta').classList.add('flex');" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors m-auto">
                            Excluir Minha Conta
                        </button>
                    </div>
                </div>
        </div>
    </div>



    <!-- Modal Confirmação de Exclusão -->
    <div id="modalDeleteConta" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white">
                <h3 class="text-lg font-bold text-gray-800">Confirmar Exclusão</h3>
                <button type="button"
                    onclick="document.getElementById('modalDeleteConta').classList.add('hidden'); document.getElementById('modalDeleteConta').classList.remove('flex');"
                    class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="px-6 py-4">
                <p class="text-gray-700 mb-4">Para confirmar a exclusão da sua conta, digite sua senha atual abaixo:</p>

                <form action="{{ route('admin.perfil.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Senha Atual</label>
                        <input type="password" name="password_delete"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 p-2 border"
                            required>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="document.getElementById('modalDeleteConta').classList.add('hidden'); document.getElementById('modalDeleteConta').classList.remove('flex');" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium">
                            Cancelar
                        </button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium">
                            Excluir Definitivamente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

@endsection
