<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminCategoriaController;
use App\Http\Controllers\Admin\AdminProdutoController;
use App\Http\Controllers\Admin\AdminMovimentacaoController;
use App\Http\Controllers\DemoController;

Route::redirect('/', '/admin/login');

Route::get('/demo/start', [DemoController::class, 'startDemo'])->name('demo.start');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::get('register', [AdminAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AdminAuthController::class, 'register']);

    Route::middleware('auth')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('categorias', AdminCategoriaController::class)->except(['show']);
        Route::resource('produtos', AdminProdutoController::class)->except(['show']);
        Route::resource('movimentacoes', AdminMovimentacaoController::class)->only(['index', 'create', 'store']);
    });
});
