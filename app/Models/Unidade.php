<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditingTrait;

class Unidade extends Model implements Auditable
{
    use HasFactory, AuditingTrait;

    protected $fillable = [
        'nome_fantasia',
        'razao_social',
        'cnpj',
        'bandeira_id',
    ];

    public function bandeira()
    {
        return $this->belongsTo(Bandeira::class);
    }
}
