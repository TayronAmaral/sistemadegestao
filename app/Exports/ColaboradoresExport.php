<?php

namespace App\Exports;

use App\Models\Colaborador;
use Maatwebsite\Excel\Concerns\FromCollection;

class ColaboradoresExport implements FromCollection
{
    public function collection()
    {
        return Colaborador::with('unidade.bandeira.grupoEconomico')->get();
    }
}
