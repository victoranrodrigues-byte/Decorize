<?php

namespace App\Services;

use App\Models\ItemModelo;

class ItemModeloService
{
    protected array $campos = [
        'modelo_id',
        'mobilia_id',
        'posicao_x',
        'posicao_y',
        'posicao_z',
        'rotacao',
        'escala',
    ];

    public function listarTodos()
    {
        return ItemModelo::all();
    }

    public function criar(array $dados)
    {
        return ItemModelo::create($this->filtrarCampos($dados));
    }

    public function buscarPorId(string $id)
    {
        return ItemModelo::find($id);
    }

    public function atualizar(ItemModelo $item, array $dados)
    {
        $item->update($this->filtrarCampos($dados));
        return $item;
    }

    public function deletar(ItemModelo $item)
    {
        $item->delete();
    }

    protected function filtrarCampos(array $dados)
    {
        return array_intersect_key($dados, array_flip($this->campos));
    }
}