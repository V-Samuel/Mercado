<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminPerfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.perfil.index', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->isDemo()) {
            return redirect()->back()->withErrors(['error' => 'Contas de demonstração não podem editar o perfil.']);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.perfil.index')->with('success', 'Perfil atualizado com sucesso!');
    }

    public function destroy(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->isDemo()) {
            return redirect()->back()->withErrors(['error' => 'Contas de demonstração não podem excluir o perfil.']);
        }

        if (is_null($user->parent_id)) {
            return redirect()->back()->withErrors(['error' => 'Contas principais não podem ser excluídas por aqui. Apenas via banco de dados.']);
        }

        $request->validate([
            'password_delete' => 'required|current_password',
        ], [
            'password_delete.current_password' => 'A senha informada está incorreta.'
        ]);

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Sua conta foi excluída com sucesso.');
    }
}
