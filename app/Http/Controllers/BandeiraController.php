<?php

namespace App\Http\Controllers;

use App\Models\Bandeira;
use App\Models\GrupoEconomico;
use Illuminate\Http\Request;

class BandeiraController extends Controller
{
    // Método para exibir o formulário de criação
    public function create()
    {
        $grupoEconomicos = GrupoEconomico::all(); // Nome corrigido
        
        return view('bandeiras.create', compact('grupoEconomicos'));
    }

    // Método para listar todas as bandeiras
    public function index()
    {
        $bandeiras = Bandeira::all();
        
        return view('bandeiras.index', compact('bandeiras'));
    }

    // Método para armazenar uma bandeira
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'grupo_economico_id' => 'required|exists:grupos_economicos,id', // Correção no nome da chave
        ]);

        Bandeira::create([
            'nome' => $request->nome,
            'grupo_economico_id' => $request->grupo_economico_id, // Correção no nome
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('bandeiras.index')->with('success', 'Bandeira criada com sucesso!');
    }

    // Método para exibir o formulário de edição
    public function edit($id)
    {
        $bandeira = Bandeira::findOrFail($id);
        $grupoEconomicos = GrupoEconomico::all();

        return view('bandeiras.edit', compact('bandeira', 'grupoEconomicos'));
    }

    // Método para atualizar uma bandeira
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'grupo_economico_id' => 'required|exists:grupos_economicos,id', // Correção no nome da chave
        ]);

        $bandeira = Bandeira::findOrFail($id);
        
        $bandeira->update([
            'nome' => $request->nome,
            'grupo_economico_id' => $request->grupo_economico_id, // Correção no nome
        ]);

        return redirect()->route('bandeiras.index')->with('success', 'Bandeira atualizada com sucesso!');
    }

    // Método para excluir uma bandeira
    public function destroy($id)
    {
        $bandeira = Bandeira::findOrFail($id);
        $bandeira->delete();

        return redirect()->route('bandeiras.index')->with('success', 'Bandeira excluída com sucesso!');
    }
}
