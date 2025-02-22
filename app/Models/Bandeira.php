<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bandeira extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', // Permite o preenchimento do campo 'nome'
        'grupo_economico_id', // FK que vai se relacionar com a tabela grupo_economico
    ];

    public function grupoEconomico()
    {
        return $this->belongsTo(GrupoEconomico::class, 'grupo_economico_id');
    }
}
