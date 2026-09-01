<?php

namespace App\Services;

use App\Models\Projeto;

class ProjetoService
{
    public function listarTodos()
    {
        return Projeto::all();
    }

    public function criar(array $dados)
    {
        return Projeto::create($dados);
    }

    public function buscarPorId(string $id)
    {
        return Projeto::find($id);
    }

    public function atualizar(Projeto $projeto, array $dados)
    {
        $projeto->update($dados);
        return $projeto;
    }

    public function deletar(Projeto $projeto)
    {
        $projeto->delete();
    }
}