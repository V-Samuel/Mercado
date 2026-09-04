<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Database\Seeders\DemoSeeder;

class DemoController extends Controller
{
    public function startDemo()
    {
        $randomString = Str::random(5);
        $email = "demo_{$randomString}@sandbox.aemek.com";
        $password = Str::random(10);

        // Criar usuário de demonstração
        $user = User::create([
            'name' => 'Usuário de Demonstração',
            'email' => $email,
            'password' => Hash::make($password),
            'nivel_acesso' => 'admin' // Assumindo que admin é necessário para acessar o painel
        ]);

        // Autenticar o usuário para que os Global Scopes e Observers funcionem no Seeder
        Auth::login($user);

        // Rodar o seeder para popular as tabelas com os dados predefinidos
        $seeder = new DemoSeeder();
        $seeder->run($user);

        // Redirecionar para o dashboard
        return redirect()->route('admin.dashboard')->with('success', 'Bem-vindo ao ambiente de demonstração! Este ambiente é isolado e seus dados serão apagados em 45 minutos.');
    }
}
