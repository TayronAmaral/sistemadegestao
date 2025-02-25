<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditingTrait;

class Colaborador extends Model implements Auditable
{
    use HasFactory, AuditingTrait;

    protected $table = 'colaboradores';

    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'unidade_id',
    ];

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }
}
