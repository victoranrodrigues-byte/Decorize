<?php

namespace App\Http\Controllers;

use App\Services\AmbienteService;
use Illuminate\Http\Request;

class AmbienteController extends Controller
{
    protected AmbienteService $service;

    public function __construct(AmbienteService $service)
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
            'projeto_id' => 'required|exists:projetos,id',
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'largura' => 'nullable|numeric',
            'comprimento' => 'nullable|numeric',
            'altura' => 'nullable|numeric',
        ]);

        $ambiente = $this->service->criar($dados);

        return response()->json($ambiente, 201);
    }

    public function show(string $id)
    {
        $ambiente = $this->service->buscarPorId($id);

        if (!$ambiente) {
            return response()->json(['mensagem' => 'Ambiente não encontrado'], 404);
        }

        return response()->json($ambiente, 200);
    }

    public function update(Request $request, string $id)
    {
        $ambiente = $this->service->buscarPorId($id);

        if (!$ambiente) {
            return response()->json(['mensagem' => 'Ambiente não encontrado'], 404);
        }

        $dados = $request->validate([
            'projeto_id' => 'required|exists:projetos,id',
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'largura' => 'nullable|numeric',
            'comprimento' => 'nullable|numeric',
            'altura' => 'nullable|numeric',
        ]);

        $ambiente = $this->service->atualizar($ambiente, $dados);

        return response()->json($ambiente, 200);
    }

    public function destroy(string $id)
    {
        $ambiente = $this->service->buscarPorId($id);

        if (!$ambiente) {
            return response()->json(['mensagem' => 'Ambiente não encontrado'], 404);
        }

        $this->service->deletar($ambiente);

        return response()->noContent();
    }
}