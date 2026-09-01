<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Projeto;
use App\Models\Midia;
use App\Models\Modelo;

class Ambiente extends Model
{
    protected $fillable = [
        'projeto_id',
        'nome',
        'tipo',
        'largura',
        'comprimento',
        'altura',
    ];

    public function projeto()
    {
        return $this->belongsTo(Projeto::class);
    }

    public function midias()
    {
        return $this->hasMany(Midia::class);
    }
    public function modelos()
    {
        return $this->hasMany(Modelo::class);
    }
}
