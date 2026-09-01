<?php

namespace App\Services;

use App\Models\Mobilia;

class MobiliaService
{
    public function listarTodas()
    {
        return Mobilia::all();
    }

    public function criar(array $dados)
    {
        return Mobilia::create($dados);
    }

    public function buscarPorId(string $id)
    {
        return Mobilia::find($id);
    }

    public function atualizar(Mobilia $mobilia, array $dados)
    {
        $mobilia->update($dados);
        return $mobilia;
    }

    public function deletar(Mobilia $mobilia)
    {
        $mobilia->delete();
    }
}