<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminEquipeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Pega todos os membros do mesmo grupo (incluindo o dono da conta), exceto o usuário logado atual
        $tenantId = $user->tenant_id;
        $equipe = User::where(function ($query) use ($tenantId) {
            $query->where('id', $tenantId)
                  ->orWhere('parent_id', $tenantId);
        })->where('id', '!=', Auth::id())->get();

        return view('admin.equipe.index', compact('equipe', 'user'));
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->isDemo()) {
            return redirect()->back()->withErrors(['error' => 'Contas de demonstração não podem criar novos membros.']);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
            'nivel_acesso' => 'required|in:admin,operador'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nivel_acesso' => $request->nivel_acesso,
            'parent_id' => $user->tenant_id,
        ]);

        return redirect()->route('admin.equipe.index')->with('success', 'Membro da equipe criado com sucesso!');
    }

    public function destroy(User $equipe)
    {

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->isDemo()) {
            return redirect()->back()->withErrors(['error' => 'Contas de demonstração não podem remover membros.']);
        }

        $tenantId = $user->tenant_id;

        // Garante que o admin só pode deletar membros da sua própria equipe
        if ($equipe->parent_id !== $tenantId && $equipe->id !== $tenantId) {
            abort(403, 'Acesso negado');
        }

        // Impede de deletar a conta principal (dono do grupo)
        if ($equipe->id === $tenantId) {
            return redirect()->route('admin.equipe.index')->withErrors(['error' => 'Você não pode remover a conta principal do grupo.']);
        }

        $equipe->delete();

        return redirect()->route('admin.equipe.index')->with('success', 'Membro da equipe removido com sucesso!');
    }
}
