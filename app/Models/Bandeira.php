<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditingTrait;

class Bandeira extends Model implements Auditable
{
    use HasFactory, AuditingTrait;

    protected $fillable = [
        'nome', 
        'grupo_economico_id',
    ];

    public function grupoEconomico()
    {
        return $this->belongsTo(GrupoEconomico::class, 'grupo_economico_id');
    }
}
