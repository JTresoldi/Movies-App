<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\MovieList;

class ProfileController extends Controller
{
    // Formulário de edição (precisa estar logada)
    public function edit()
    {
        $user = Auth::user();
        return view('perfil-editar', compact('user'));
    }

    // Salvar alterações
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:4', // só troca se preencher
        ]);

        $user->name  = $data['name'];
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()->route('perfil')->with('ok', 'Perfil atualizado!');
    }

    // Perfil público: /u/{user}
    public function public(User $user)
    {
        $publicLists = MovieList::where('user_id', $user->id)
            ->where('is_public', true)
            ->get();

        return view('perfil-publico', compact('user', 'publicLists'));
    }
}
