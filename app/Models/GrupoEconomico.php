<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditingTrait;

class GrupoEconomico extends Model implements Auditable
{
    use HasFactory, AuditingTrait;

    protected $table = 'grupos_economicos'; // Define explicitamente a tabela

    protected $fillable = ['nome']; // Permite atribuição em massa
}
