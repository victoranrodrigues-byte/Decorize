<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ambiente;
use App\Models\ItemModelo;

class Modelo extends Model
{
    protected $fillable = [
        'ambiente_id',
        'nome',
        'tipo',
        'origem',
        'estilo',
    ];

    public function ambiente()
    {
        return $this->belongsTo(Ambiente::class);
    }

    public function itens()
    {
        return $this->hasMany(ItemModelo::class);
    }
}
