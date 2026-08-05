<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - @yield('title', 'Dashboard')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('mercado.ico') }}">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="flex h-screen overflow-hidden relative">
        
        <!-- Mobile sidebar backdrop -->
        <div id="sidebarBackdrop" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-40 hidden md:hidden transition-opacity"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-white shadow-md shrink-0 flex flex-col absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out z-50 h-full">
            <div class="p-6 border-b">
                <h1 class="text-2xl font-bold text-indigo-600">Painel do Admin</h1>
            </div>
            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">Dashboard</a>
                <a href="{{ route('admin.produtos.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.produtos.*') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">Produtos</a>
                <a href="{{ route('admin.categorias.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.categorias.*') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">Categorias</a>
                <a href="{{ route('admin.movimentacoes.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.movimentacoes.*') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">Movimentações</a>
            </nav>
            <div class="p-4 border-t">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-stone-200 w-full text-center px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg font-semibold">Sair</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Header for mobile / User info -->
            <header class="bg-white shadow-sm z-10 flex items-center justify-between p-4 md:px-6">
                <div class="flex items-center md:hidden">
                    <button id="mobileMenuBtn" class="text-gray-600 hover:text-gray-900 focus:outline-none mr-3">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-xl font-bold text-indigo-600">Painel do Admin</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-base font-medium text-gray-700">Olá, {{ Auth::user()->name ?? 'Administrador' }}</span>
                </div>
            </header>

            <!-- Content -->
            <div class="flex-1 overflow-auto p-4 md:p-6">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('mobileMenuBtn');
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebarBackdrop');

            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                backdrop.classList.toggle('hidden');
            }

            if (btn && sidebar && backdrop) {
                btn.addEventListener('click', toggleSidebar);
                backdrop.addEventListener('click', toggleSidebar);
            }
        });
    </script>
</body>
</html>
