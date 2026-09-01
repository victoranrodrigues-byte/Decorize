<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ItemModelo;

class Mobilia extends Model
{
    protected $fillable = [
        'nome',
        'dimensao',
        'cor',
        'tipo',
    ];

    public function itensModelo()
    {
        return $this->hasMany(ItemModelo::class);
    }
}
