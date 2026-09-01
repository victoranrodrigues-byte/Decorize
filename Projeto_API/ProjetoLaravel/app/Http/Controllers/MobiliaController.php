<?php

namespace App\Http\Controllers;

use App\Services\MobiliaService;
use Illuminate\Http\Request;

class MobiliaController extends Controller
{
    protected MobiliaService $service;

    public function __construct(MobiliaService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->listarTodas(), 200);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:100',
            'dimensao' => 'nullable|string|max:100',
            'cor' => 'nullable|string|max:50',
            'tipo' => 'nullable|string|max:50',
        ]);

        $mobilia = $this->service->criar($dados);

        return response()->json($mobilia, 201);
    }

    public function show(string $id)
    {
        $mobilia = $this->service->buscarPorId($id);

        if (!$mobilia) {
            return response()->json(['mensagem' => 'Mobília não encontrada'], 404);
        }

        return response()->json($mobilia, 200);
    }

    public function update(Request $request, string $id)
    {
        $mobilia = $this->service->buscarPorId($id);

        if (!$mobilia) {
            return response()->json(['mensagem' => 'Mobília não encontrada'], 404);
        }

        $dados = $request->validate([
            'nome' => 'required|string|max:100',
            'dimensao' => 'nullable|string|max:100',
            'cor' => 'nullable|string|max:50',
            'tipo' => 'nullable|string|max:50',
        ]);

        $mobilia = $this->service->atualizar($mobilia, $dados);

        return response()->json($mobilia, 200);
    }

    public function destroy(string $id)
    {
        $mobilia = $this->service->buscarPorId($id);

        if (!$mobilia) {
            return response()->json(['mensagem' => 'Mobília não encontrada'], 404);
        }

        $this->service->deletar($mobilia);

        return response()->noContent();
    }
}