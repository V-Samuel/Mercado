<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('mercado.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full text-center">
    
        <div class="flex justify-center mb-6">
            @yield('icon', '<svg class="w-24 h-24 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>')
        </div>
        
        <h1 class="text-4xl font-bold text-gray-900 mb-4">@yield('code', 'Erro')</h1>
        
        <h2 class="text-xl font-semibold text-gray-700 mb-2">@yield('message')</h2>
        
        <p class="text-gray-500 mb-6">@yield('description', 'Desculpe, ocorreu um erro inesperado.')</p>
        
        <div class="flex justify-center gap-4">
            <button onclick="window.history.back()" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-medium">
                Voltar
            </button>
            <a href="{{ route('admin.login') }}" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                Página Inicial
            </a>
        </div>
    </div>
</body>
</html>
