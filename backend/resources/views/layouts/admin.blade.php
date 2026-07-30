<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - @yield('title', 'Dashboard')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6 border-b">
                <h1 class="text-2xl font-bold text-indigo-600">Admin Panel</h1>
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
                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 rounded font-semibold">Sair</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Header for mobile / User info -->
            <header class="bg-white shadow-sm z-10 flex items-center justify-between p-4 md:px-6">
                <div class="md:hidden">
                    <h1 class="text-xl font-bold text-indigo-600">Admin Panel</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-gray-700">Olá, {{ Auth::user()->name ?? 'Administrador' }}</span>
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
</body>
</html>
