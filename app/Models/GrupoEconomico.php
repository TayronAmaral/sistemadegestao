<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoEconomico extends Model
{
    use HasFactory;

    protected $table = 'grupos_economicos'; // Define explicitamente a tabela

    protected $fillable = ['nome']; // Permite atribuição em massa
}
