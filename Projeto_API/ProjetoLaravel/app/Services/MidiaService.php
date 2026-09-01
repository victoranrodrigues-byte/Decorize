<?php

namespace App\Services;

use App\Models\Midia;

class MidiaService
{
    public function listarTodas()
    {
        return Midia::all();
    }

    public function criar(array $dados)
    {
        return Midia::create($dados);
    }

    public function buscarPorId(string $id)
    {
        return Midia::find($id);
    }

    public function atualizar(Midia $midia, array $dados)
    {
        $midia->update($dados);
        return $midia;
    }

    public function deletar(Midia $midia)
    {
        $midia->delete();
    }
}