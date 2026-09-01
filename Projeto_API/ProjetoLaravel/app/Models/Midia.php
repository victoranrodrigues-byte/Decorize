<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ambiente;

class Midia extends Model
{
    protected $fillable = [
        'ambiente_id',
        'tipo',
        'url',
        'nome_arquivo',
    ];

    public function ambiente()
    {
        return $this->belongsTo(Ambiente::class);
    }
}
