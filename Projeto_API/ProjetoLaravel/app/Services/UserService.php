<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function listarTodos()
    {
        return User::all();
    }

    public function criar(array $dados)
    {
        return User::create([
            'name' => $dados['name'],
            'email' => $dados['email'],
            'password' => Hash::make($dados['password']),
        ]);
    }

    public function buscarPorId(string $id)
    {
        return User::find($id);
    }

    public function atualizar(User $user, array $dados)
    {
        $user->name = $dados['name'];
        $user->email = $dados['email'];

        if (!empty($dados['password'])) {
            $user->password = Hash::make($dados['password']);
        }

        $user->save();

        return $user;
    }

    public function deletar(User $user)
    {
        $user->delete();
    }

    public function autentificar(array $credenciais): bool
    {
        return \Illuminate\Support\Facades\Auth::attempt($credenciais);
    }

    public function logout(): void
    {
        \Illuminate\Support\Facades\Auth::logout();
    }
}