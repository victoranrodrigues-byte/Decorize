<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->listarTodos(), 200);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = $this->service->criar($dados);

        return response()->json($user, 201);
    }

    public function show(string $id)
    {
        $user = $this->service->buscarPorId($id);

        if (!$user) {
            return response()->json(['mensagem' => 'Usuário não encontrado'], 404);
        }

        return response()->json($user, 200);
    }

    public function update(Request $request, string $id)
    {
        $user = $this->service->buscarPorId($id);

        if (!$user) {
            return response()->json(['mensagem' => 'Usuário não encontrado'], 404);
        }

        $dados = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ]);

        $user = $this->service->atualizar($user, $dados);

        return response()->json($user, 200);
    }

    public function destroy(string $id)
    {
        $user = $this->service->buscarPorId($id);

        if (!$user) {
            return response()->json(['mensagem' => 'Usuário não encontrado'], 404);
        }

        $this->service->deletar($user);

        return response()->noContent();
    }

    #PARTE DE LOGIN#
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credenciais = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!$this->service->autentificar($credenciais)) {
            return back()
                ->withErrors(['email' => 'Credenciais inválidas'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended('/home');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $dados = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = $this->service->criar($dados);

        auth()->login($user);

        return redirect('/home');
    }

    public function logout(Request $request)
    {
        $this->service->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}