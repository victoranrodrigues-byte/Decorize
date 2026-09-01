<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemModelo extends Model
{
    protected $fillable = [
        'modelo_id',
        'mobilia_id',
        'posicao_x',
        'posicao_y',
        'posicao_z',
        'rotacao',
        'escala',
    ];

    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }

    public function mobilia()
    {
        return $this->belongsTo(Mobilia::class);
    }
}
