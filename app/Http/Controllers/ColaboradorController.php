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

    public function edit($id)
    {
        $colaborador = Colaborador::findOrFail($id);
        $unidades = Unidade::all();
        return view('colaboradores.edit', compact('colaborador', 'unidades'));
    }

    public function update(Request $request, $id)
    {
        // Buscar o colaborador pelo ID
        $colaborador = Colaborador::findOrFail($id);
    
        // Validar os dados antes da atualização
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('colaboradores', 'email')->ignore($colaborador->id),
            ],
            'cpf' => [
                'required',
                'string',
                'max:14',
                Rule::unique('colaboradores', 'cpf')->ignore($colaborador->id),
            ],
            'unidade_id' => 'required|exists:unidades,id',
        ]);
    
        // Atualizar os dados do colaborador
        $colaborador->update($validated);
    
        // Redirecionar com mensagem de sucesso
        return redirect()->route('colaboradores.index')->with('success', 'Colaborador atualizado com sucesso!');
    }
    

    public function destroy($id)
    {
        $colaborador = Colaborador::find($id);

        if ($colaborador) {
            $colaborador->delete();
            return redirect()->route('colaboradores.index')->with('success', 'Colaborador excluído com sucesso.');
        }

        return redirect()->route('colaboradores.index')->with('error', 'Colaborador não encontrado.');
    }
}
