<?php

namespace App\Http\Controllers;

use App\Services\ProjetoService;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{
    protected ProjetoService $service;

    public function __construct(ProjetoService $service)
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
            'user_id' => 'required|exists:users,id',
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'status' => 'required|in:rascunho,em_andamento,finalizado',
        ]);

        $projeto = $this->service->criar($dados);

        return response()->json($projeto, 201);
    }

    public function show(string $id)
    {
        $projeto = $this->service->buscarPorId($id);

        if (!$projeto) {
            return response()->json(['mensagem' => 'Projeto não encontrado'], 404);
        }

        return response()->json($projeto, 200);
    }

    public function update(Request $request, string $id)
    {
        $projeto = $this->service->buscarPorId($id);

        if (!$projeto) {
            return response()->json(['mensagem' => 'Projeto não encontrado'], 404);
        }

        $dados = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'status' => 'required|in:rascunho,em_andamento,finalizado',
        ]);

        $projeto = $this->service->atualizar($projeto, $dados);

        return response()->json($projeto, 200);
    }

    public function destroy(string $id)
    {
        $projeto = $this->service->buscarPorId($id);

        if (!$projeto) {
            return response()->json(['mensagem' => 'Projeto não encontrado'], 404);
        }

        $this->service->deletar($projeto);

        return response()->noContent();
    }
}