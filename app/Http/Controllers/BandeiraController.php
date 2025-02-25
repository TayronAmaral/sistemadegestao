<?php

namespace App\Http\Controllers;

use App\Models\Bandeira;
use App\Models\GrupoEconomico;
use Illuminate\Http\Request;

class BandeiraController extends Controller
{    
    public function create()
    {
        $grupoEconomicos = GrupoEconomico::all(); // Nome corrigido
        
        return view('bandeiras.create', compact('grupoEconomicos'));
    }

    
    public function index()
    {
        $bandeiras = Bandeira::all();
        
        return view('bandeiras.index', compact('bandeiras'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'grupo_economico_id' => 'required|exists:grupos_economicos,id', 
        ]);

        Bandeira::create([
            'nome' => $request->nome,
            'grupo_economico_id' => $request->grupo_economico_id, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('bandeiras.index')->with('success', 'Bandeira criada com sucesso!');
    }
    
    public function edit($id)
    {
        $bandeira = Bandeira::findOrFail($id);
        $grupoEconomicos = GrupoEconomico::all();

        return view('bandeiras.edit', compact('bandeira', 'grupoEconomicos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'grupo_economico_id' => 'required|exists:grupos_economicos,id', 
        ]);

        $bandeira = Bandeira::findOrFail($id);
        
        $bandeira->update([
            'nome' => $request->nome,
            'grupo_economico_id' => $request->grupo_economico_id, 
        ]);

        return redirect()->route('bandeiras.index')->with('success', 'Bandeira atualizada com sucesso!');
    }

        public function destroy($id)
    {
        $bandeira = Bandeira::findOrFail($id);
        $bandeira->delete();

        return redirect()->route('bandeiras.index')->with('success', 'Bandeira excluída com sucesso!');
    }
}
