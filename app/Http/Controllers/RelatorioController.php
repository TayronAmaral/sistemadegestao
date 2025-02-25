<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colaborador;
use App\Models\Unidade;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ColaboradoresExport;
use TCPDF;

class RelatorioController extends Controller
{
    public function colaboradores(Request $request)
    {
        $query = Colaborador::query()->with('unidade.bandeira.grupoEconomico');
        
        if ($request->filled('unidade_id')) {
            $query->where('unidade_id', $request->unidade_id);
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('cpf')) {
            $query->where('cpf', 'like', '%' . $request->cpf . '%');
        }
       
        $colaboradores = $query->paginate(10);
        $unidades = Unidade::all();

        return view('relatorios.colaboradores', compact('colaboradores', 'unidades'));
    }
    
    public function exportExcel(Request $request)
    {
        return Excel::download(new ColaboradoresExport($request), 'colaboradores.xlsx');
    }
  
    public function exportPdf(Request $request)
    {
        try {
            $query = Colaborador::query()->with('unidade.bandeira.grupoEconomico');

            if ($request->filled('unidade_id')) {
                $query->where('unidade_id', $request->unidade_id);
            }

            if ($request->filled('email')) {
                $query->where('email', 'like', '%' . $request->email . '%');
            }

            if ($request->filled('cpf')) {
                $query->where('cpf', 'like', '%' . $request->cpf . '%');
            }

            $colaboradores = $query->get();
            
            if (!view()->exists('relatorios.pdf_colaboradores')) {
                return response()->json(['error' => 'A view para geração do PDF não foi encontrada.'], 500);
            }
            
            $html = view('relatorios.pdf_colaboradores', compact('colaboradores'))->render();
           
            $pdf = new TCPDF();
            $pdf->SetCreator('Laravel');
            $pdf->SetAuthor('Seu Nome');
            $pdf->SetTitle('Relatório de Colaboradores');
            $pdf->SetSubject('Lista de Colaboradores');
            $pdf->SetMargins(10, 10, 10);
            $pdf->AddPage();
            
            $pdf->SetFont('helvetica', '', 12);
            $pdf->writeHTML($html, true, false, true, false, '');
            
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->Output('', 'S');
            }, 'colaboradores.pdf');

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao gerar PDF: ' . $e->getMessage(),
            ], 500);
        }
    }
}
