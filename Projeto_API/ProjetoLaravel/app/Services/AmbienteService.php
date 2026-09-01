<?php

namespace App\Services;

use App\Models\Ambiente;

class AmbienteService
{
    public function listarTodos()
    {
        return Ambiente::all();
    }

    public function criar(array $dados)
    {
        return Ambiente::create($dados);
    }

    public function buscarPorId(string $id)
    {
        return Ambiente::find($id);
    }

    public function atualizar(Ambiente $ambiente, array $dados)
    {
        $ambiente->update($dados);
        return $ambiente;
    }

    public function deletar(Ambiente $ambiente)
    {
        $ambiente->delete();
    }
}