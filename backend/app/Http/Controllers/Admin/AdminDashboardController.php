<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $produtosCount = Produto::count();
        $categoriasCount = Categoria::count();
        // Add more stats if needed
        return view('admin.dashboard', compact('produtosCount', 'categoriasCount'));
    }
}
