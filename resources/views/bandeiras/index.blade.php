@extends('layouts.app')

@section('header')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Bandeiras
            </h2>
        </div>
    </header>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">

                <!-- Título da Lista de Bandeiras -->
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Lista de Bandeiras</h3>

                <!-- Botão para adicionar nova bandeira -->
                <div class="mb-4 flex justify-end">
                    <a href="{{ route('bandeiras.create') }}" 
                       class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition-all">
                        Criar Nova Bandeira
                    </a>
                </div>

                <!-- Tabela de Bandeiras -->
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white">
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">ID</th>
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Nome</th>
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bandeiras as $bandeira)
                            <tr class="border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">{{ $bandeira->id }}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $bandeira->nome }}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 flex justify-center gap-2">
                                    <a href="{{ route('bandeiras.edit', $bandeira->id) }}" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                                        Editar
                                    </a>
                                    <form action="{{ route('bandeiras.destroy', $bandeira->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta bandeira?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
