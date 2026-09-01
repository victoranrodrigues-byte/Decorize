<?php

namespace App\Http\Controllers;

use App\Models\Midia;
use App\Services\MidiaService;
use Illuminate\Http\Request;

class MidiaController extends Controller
{
    protected MidiaService $service;

    public function __construct(MidiaService $service)
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
            'ambiente_id' => 'required|exists:ambientes,id',
            'tipo' => 'required|in:imagem,video',
            'url' => 'required|string|max:500',
            'nome_arquivo' => 'required|string|max:255',
        ]);

        $midia = $this->service->criar($dados);

        return response()->json($midia, 201);
    }

    public function show(string $id)
    {
        $midia = $this->service->buscarPorId($id);

        if (!$midia) {
            return response()->json(['mensagem' => 'Mídia não encontrada'], 404);
        }

        return response()->json($midia, 200);
    }

    public function update(Request $request, string $id)
    {
        $midia = $this->service->buscarPorId($id);

        if (!$midia) {
            return response()->json(['mensagem' => 'Mídia não encontrada'], 404);
        }

        $dados = $request->validate([
            'ambiente_id' => 'required|exists:ambientes,id',
            'tipo' => 'required|in:imagem,video',
            'url' => 'required|string|max:500',
            'nome_arquivo' => 'required|string|max:255',
        ]);

        $midia = $this->service->atualizar($midia, $dados);

        return response()->json($midia, 200);
    }

    public function destroy(string $id)
    {
        $midia = $this->service->buscarPorId($id);

        if (!$midia) {
            return response()->json(['mensagem' => 'Mídia não encontrada'], 404);
        }

        $this->service->deletar($midia);

        return response()->noContent();
    }
}