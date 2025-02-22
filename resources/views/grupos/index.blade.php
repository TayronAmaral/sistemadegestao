@extends('layouts.app')

@section('header')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Grupos Econômicos
            </h2>
        </div>
    </header>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Botão para adicionar um novo grupo --}}
            <div class="mb-6 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Lista de Grupos</h3>
                <a href="{{ route('grupos.create') }}" 
                   class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg shadow-md transition-all">
                    + Adicionar Grupo
                </a>
            </div>

            {{-- Exibe mensagens de sucesso, se houver --}}
            @if(session('success'))
                <div class="bg-green-500 text-white p-3 rounded-lg mb-4 shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Verifica se existem grupos cadastrados --}}
            @if($grupos->count() > 0)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="w-full border-collapse border border-gray-300 dark:border-gray-600 text-left">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-3">Nome</th>
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grupos as $grupo)
                                <tr class="odd:bg-gray-100 even:bg-gray-50 dark:odd:bg-gray-700 dark:even:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-gray-900 dark:text-gray-100">{{ $grupo->nome }}</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center space-x-2">
                                        {{-- Botão Editar --}}
                                        <a href="{{ route('grupos.edit', $grupo->id) }}" 
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg shadow-md transition-all">
                                            Editar
                                        </a>
                                        
                                        {{-- Formulário de Exclusão --}}
                                        <form action="{{ route('grupos.destroy', $grupo->id) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('Tem certeza que deseja excluir este grupo?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg shadow-md transition-all">
                                                Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-900 dark:text-gray-100 text-center mt-6 text-lg font-semibold">
                    Nenhum grupo econômico cadastrado.
                </p>
            @endif
        </div>
    </div>
@endsection
