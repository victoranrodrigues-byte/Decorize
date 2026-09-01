<?php

namespace App\Models;

use App\Models\Ambiente;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $fillable = [
        'user_id',
        'nome',
        'descricao',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ambientes()
    {
        return $this->hasMany(Ambiente::class);
    }
}
