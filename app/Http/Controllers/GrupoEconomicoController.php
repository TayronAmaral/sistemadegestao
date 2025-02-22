<?php
namespace App\Http\Controllers;

use App\Models\GrupoEconomico;
use Illuminate\Http\Request;

class GrupoEconomicoController extends Controller
{
    public function index()
    {
        $grupos = GrupoEconomico::all();
        return view('grupos.index', compact('grupos'));
    }

    public function create()
    {
        return view('grupos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|unique:grupos_economicos|max:255',
        ]);

        GrupoEconomico::create($request->all());
        return redirect()->route('grupos.index')->with('success', 'Grupo Econômico criado com sucesso!');
    }

    public function edit($id)
    {
        $grupo = GrupoEconomico::findOrFail($id);
        return view('grupos.edit', compact('grupo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|max:255|unique:grupos_economicos,nome,' . $id,
        ]);

        $grupo = GrupoEconomico::findOrFail($id);
        $grupo->update($request->all());
        return redirect()->route('grupos.index')->with('success', 'Grupo atualizado com sucesso!');
    }

    public function destroy($id)
    {
        GrupoEconomico::destroy($id);
        return redirect()->route('grupos.index')->with('success', 'Grupo removido com sucesso!');
    }
}
