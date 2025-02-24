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
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <div class="mb-6 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Lista de Grupos</h3>
                    <a href="{{ route('grupos.create') }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg shadow-md transition-all">
                        + Adicionar Grupo
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-500 text-white p-3 rounded-lg mb-4 shadow-md">
                        {{ session('success') }}
                    </div>
                @endif

                @if($grupos->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-full border-collapse border border-gray-300 dark:border-gray-600 text-left">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-200">
                                    <th class="px-4 py-2 border">ID</th>
                                    <th class="px-4 py-2 border">Nome</th>
                                    <th class="px-4 py-2 border">Data de Criação</th>
                                    <th class="px-4 py-2 border">Última Atualização</th>
                                    <th class="px-4 py-2 border text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($grupos as $grupo)
                                    <tr class="odd:bg-gray-100 even:bg-gray-50 dark:odd:bg-gray-700 dark:even:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                        <td class="px-4 py-2 border whitespace-nowrap text-gray-900 dark:text-gray-200">{{ $grupo->id }}</td>
                                        <td class="px-4 py-2 border whitespace-nowrap text-gray-900 dark:text-gray-200">{{ $grupo->nome }}</td>
                                        <td class="px-4 py-2 border whitespace-nowrap text-gray-900 dark:text-gray-200">{{ $grupo->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="px-4 py-2 border whitespace-nowrap text-gray-900 dark:text-gray-200">{{ $grupo->updated_at->format('d/m/Y H:i') }}</td>
                                        <td class="px-4 py-2 border whitespace-nowrap">
                                            <div class="flex flex-wrap gap-2 justify-center">
                                                <a href="{{ route('grupos.edit', $grupo->id) }}" 
                                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg shadow-md transition-all">
                                                    Editar
                                                </a>
                                                <form action="{{ route('grupos.destroy', $grupo->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este grupo?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg shadow-md transition-all">
                                                        Excluir
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-900 dark:text-gray-200 text-center mt-6 text-lg font-semibold">
                        Nenhum grupo econômico cadastrado.
                    </p>
                @endif
            </div>
        </div>
    </div>
@endsection
