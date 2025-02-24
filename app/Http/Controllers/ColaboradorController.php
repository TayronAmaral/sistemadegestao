<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ColaboradorController extends Controller
{
    public function index()
    {
        $colaboradores = Colaborador::with('unidade')->paginate(10);
        return view('colaboradores.index', compact('colaboradores'));
    }

    public function create()
    {
        $unidades = Unidade::all();
        return view('colaboradores.create', compact('unidades'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:colaboradores,email',
            'cpf' => 'required|string|max:14|unique:colaboradores,cpf',
            'unidade_id' => 'required|exists:unidades,id',
        ]);

        Colaborador::create($validated);

        return redirect()->route('colaboradores.index')->with('success', 'Colaborador criado com sucesso!');
    }

    public function edit($colaborador) // Altere $colaboradore para $colaborador
    {
        $colaborador = Colaborador::findOrFail($colaborador);  // Buscar o colaborador no banco de dados
        $unidades = Unidade::all(); // Buscar as unidades, caso necessário
        return view('colaboradores.edit', compact('colaborador', 'unidades'));  // Passar para a view
    }
    



    public function update(Request $request, Colaborador $colaborador)
{
    // Garantir que o 'unidade_id' não seja vazio
    $validated = $request->validate([
        'nome' => 'required|string|max:255',
        'email' => Rule::unique('colaboradores')->ignore($colaborador->id),
        'cpf' => Rule::unique('colaboradores')->ignore($colaborador->id),
        'unidade_id' => 'required|exists:unidades,id',  // Mantenha a validação obrigatória
    ]);

    $colaborador->update($validated);

    return redirect()->route('colaboradores.index')->with('success', 'Colaborador atualizado com sucesso!');
}


    public function destroy(Colaborador $colaborador)
{
    if ($colaborador) {
        $colaborador->forceDelete(); // 🔥 Isso remove do banco definitivamente
        return redirect()->route('colaboradores.index')->with('success', 'Colaborador excluído permanentemente.');
    }

    return redirect()->route('colaboradores.index')->with('error', 'Colaborador não encontrado.');
}

}
