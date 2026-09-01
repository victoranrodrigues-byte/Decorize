<?php

namespace App\Http\Controllers;

use App\Services\ItemModeloService;
use Illuminate\Http\Request;

class ItemModeloController extends Controller
{
    protected ItemModeloService $service;

    public function __construct(ItemModeloService $service)
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
            'modelo_id' => 'required|exists:modelos,id',
            'mobilia_id' => 'required|exists:mobilias,id',
            'posicao_x' => 'required|numeric',
            'posicao_y' => 'required|numeric',
            'posicao_z' => 'required|numeric',
            'rotacao' => 'required|numeric',
            'escala' => 'required|numeric',
        ]);

        $item = $this->service->criar($dados);

        return response()->json($item, 201);
    }

    public function show(string $id)
    {
        $item = $this->service->buscarPorId($id);

        if (!$item) {
            return response()->json(['mensagem' => 'Item do modelo não encontrado'], 404);
        }

        return response()->json($item, 200);
    }

    public function update(Request $request, string $id)
    {
        $item = $this->service->buscarPorId($id);

        if (!$item) {
            return response()->json(['mensagem' => 'Item do modelo não encontrado'], 404);
        }

        $dados = $request->validate([
            'modelo_id' => 'required|exists:modelos,id',
            'mobilia_id' => 'required|exists:mobilias,id',
            'posicao_x' => 'required|numeric',
            'posicao_y' => 'required|numeric',
            'posicao_z' => 'required|numeric',
            'rotacao' => 'required|numeric',
            'escala' => 'required|numeric',
        ]);

        $item = $this->service->atualizar($item, $dados);

        return response()->json($item, 200);
    }

    public function destroy(string $id)
    {
        $item = $this->service->buscarPorId($id);

        if (!$item) {
            return response()->json(['mensagem' => 'Item do modelo não encontrado'], 404);
        }

        $this->service->deletar($item);

        return response()->noContent();
    }
}