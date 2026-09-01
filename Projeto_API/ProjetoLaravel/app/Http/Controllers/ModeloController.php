<?php

namespace App\Http\Controllers;

use App\Services\ModeloService;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    protected ModeloService $service;

    public function __construct(ModeloService $service)
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
            'ambiente_id' => 'required|exists:ambientes,id',
            'nome' => 'required|string|max:255',
            'tipo' => 'required|in:2D,3D',
            'origem' => 'required|in:IA,MANUAL',
            'estilo' => 'nullable|string|max:255',
        ]);

        $modelo = $this->service->criar($dados);

        return response()->json($modelo, 201);
    }

    public function show(string $id)
    {
        $modelo = $this->service->buscarPorId($id);

        if (!$modelo) {
            return response()->json(['mensagem' => 'Modelo não encontrado'], 404);
        }

        return response()->json($modelo, 200);
    }

    public function update(Request $request, string $id)
    {
        $modelo = $this->service->buscarPorId($id);

        if (!$modelo) {
            return response()->json(['mensagem' => 'Modelo não encontrado'], 404);
        }

        $dados = $request->validate([
            'ambiente_id' => 'required|exists:ambientes,id',
            'nome' => 'required|string|max:255',
            'tipo' => 'required|in:2D,3D',
            'origem' => 'required|in:IA,MANUAL',
            'estilo' => 'nullable|string|max:255',
        ]);

        $modelo = $this->service->atualizar($modelo, $dados);

        return response()->json($modelo, 200);
    }

    public function destroy(string $id)
    {
        $modelo = $this->service->buscarPorId($id);

        if (!$modelo) {
            return response()->json(['mensagem' => 'Modelo não encontrado'], 404);
        }

        $this->service->deletar($modelo);

        return response()->noContent();
    }
}