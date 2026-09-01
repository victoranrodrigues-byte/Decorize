<?php

namespace App\Services;

use App\Models\Modelo;

class ModeloService
{
    public function listarTodos()
    {
        return Modelo::all();
    }

    public function criar(array $dados)
    {
        return Modelo::create($dados);
    }

    public function buscarPorId(string $id)
    {
        return Modelo::find($id);
    }

    public function atualizar(Modelo $modelo, array $dados)
    {
        $modelo->update($dados);
        return $modelo;
    }

    public function deletar(Modelo $modelo)
    {
        $modelo->delete();
    }
}