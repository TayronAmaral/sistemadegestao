<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use App\Models\Bandeira;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    // Método para listar todas as unidades com paginação
    public function index()
    {
        // Paginando as unidades com 10 itens por página
        $unidades = Unidade::paginate(10);  // Recupera as unidades paginadas

        // Retorna a view com as unidades paginadas
        return view('unidades.index', compact('unidades'));
    }

    // Método para exibir o formulário de criação de Unidade
    public function create()
    {
        // Recupera todas as bandeiras para seleção no formulário
        $bandeiras = Bandeira::all();  
        return view('unidades.create', compact('bandeiras'));  // Passa as bandeiras para o formulário
    }

    // Método para armazenar a Unidade no banco de dados
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'nome_fantasia' => 'required|string|max:255',
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:unidades,cnpj', // Valida o CNPJ como único
            'bandeira_id' => 'required|exists:bandeiras,id',  // Valida a bandeira
        ]);

        // Remover qualquer formatação do CNPJ
        $cnpj = preg_replace('/\D/', '', $request->cnpj); // Remove caracteres não numéricos

        // Criando a Unidade
        Unidade::create([
            'nome_fantasia' => $request->nome_fantasia,
            'razao_social' => $request->razao_social,
            'cnpj' => $cnpj,  // Salvando o CNPJ sem formatação
            'bandeira_id' => $request->bandeira_id, // A bandeira é obrigatória
        ]);

        // Redireciona o usuário de volta com uma mensagem de sucesso
        return redirect()->route('unidades.index')->with('success', 'Unidade criada com sucesso!');
    }

    // Método para editar uma Unidade existente
    public function edit($id)
    {
        // Encontra a unidade com o ID fornecido
        $unidade = Unidade::findOrFail($id);  
        // Recupera todas as bandeiras para seleção
        $bandeiras = Bandeira::all();  
        // Passa os dados para a view
        return view('unidades.edit', compact('unidade', 'bandeiras'));
    }

    // Método para atualizar a Unidade no banco de dados
    public function update(Request $request, $id)
    {
        // Validação dos dados recebidos
        $request->validate([
            'nome_fantasia' => 'required|string|max:255',
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:unidades,cnpj,' . $id,  // Valida o CNPJ com exceção ao ID atual
            'bandeira_id' => 'required|exists:bandeiras,id',  // Valida a bandeira
        ]);

        // Remover qualquer formatação do CNPJ
        $cnpj = preg_replace('/\D/', '', $request->cnpj); // Remove caracteres não numéricos

        // Atualizando a unidade
        $unidade = Unidade::findOrFail($id);
        $unidade->update([
            'nome_fantasia' => $request->nome_fantasia,
            'razao_social' => $request->razao_social,
            'cnpj' => $cnpj,  // Salvando o CNPJ sem formatação
            'bandeira_id' => $request->bandeira_id, // A bandeira é obrigatória
        ]);

        // Redireciona o usuário de volta com uma mensagem de sucesso
        return redirect()->route('unidades.index')->with('success', 'Unidade atualizada com sucesso!');
    }

    // Método para excluir uma Unidade
    public function destroy($id)
    {
        // Encontra a unidade com o ID fornecido
        $unidade = Unidade::findOrFail($id);  
        // Exclui a unidade do banco de dados
        $unidade->delete();  

        // Redireciona o usuário de volta com uma mensagem de sucesso
        return redirect()->route('unidades.index')->with('success', 'Unidade excluída com sucesso!');
    }
}
