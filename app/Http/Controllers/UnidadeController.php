<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use App\Models\Bandeira;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    public function index()
    {        
        $unidades = Unidade::paginate(10);  
        
        return view('unidades.index', compact('unidades'));
    }
   
    public function create()
    {        
        $bandeiras = Bandeira::all();  
        return view('unidades.create', compact('bandeiras'));  
    }
  
    public function store(Request $request)
    {       
        $request->validate([
            'nome_fantasia' => 'required|string|max:255',
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:unidades,cnpj', 
            'bandeira_id' => 'required|exists:bandeiras,id',  
        ]);
        
        $cnpj = preg_replace('/\D/', '', $request->cnpj); 

        Unidade::create([
            'nome_fantasia' => $request->nome_fantasia,
            'razao_social' => $request->razao_social,
            'cnpj' => $cnpj,  
            'bandeira_id' => $request->bandeira_id, 
        ]);
        
        return redirect()->route('unidades.index')->with('success', 'Unidade criada com sucesso!');
    }
   
    public function edit($id)
    {       
        $unidade = Unidade::findOrFail($id);  
        
        $bandeiras = Bandeira::all();  
        
        return view('unidades.edit', compact('unidade', 'bandeiras'));
    }
   
    public function update(Request $request, $id)
    {
       
        $request->validate([
            'nome_fantasia' => 'required|string|max:255',
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:unidades,cnpj,' . $id,  
            'bandeira_id' => 'required|exists:bandeiras,id',  
        ]);

        
        $cnpj = preg_replace('/\D/', '', $request->cnpj); 

        
        $unidade = Unidade::findOrFail($id);
        $unidade->update([
            'nome_fantasia' => $request->nome_fantasia,
            'razao_social' => $request->razao_social,
            'cnpj' => $cnpj,  
            'bandeira_id' => $request->bandeira_id, 
        ]);

        
        return redirect()->route('unidades.index')->with('success', 'Unidade atualizada com sucesso!');
    }

    
    public function destroy($id)
    {
        
        $unidade = Unidade::findOrFail($id);  
        
        $unidade->delete();  

        
        return redirect()->route('unidades.index')->with('success', 'Unidade excluída com sucesso!');
    }
}
