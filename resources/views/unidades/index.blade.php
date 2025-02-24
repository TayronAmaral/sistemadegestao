@extends('layouts.app')

@section('header')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Lista de Unidades
            </h2>
        </div>
    </header>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">

            <!-- Título da Lista de Unidades -->
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Lista de Unidades</h3>

            <!-- Botão para Adicionar Unidade -->
                <div class="flex justify-end mb-4">
                    <a href="{{ route('unidades.create') }}" 
                       class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                        Adicionar Unidade
                    </a>
                </div>

                <!-- Tabela com as Unidades Existentes -->
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-200 dark:border-gray-700">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-white">
                                <th class="px-4 py-2 border">ID</th>
                                <th class="px-4 py-2 border">Nome Fantasia</th>
                                <th class="px-4 py-2 border">Razão Social</th>
                                <th class="px-4 py-2 border">CNPJ</th>
                                <th class="px-4 py-2 border">Bandeira</th>
                                <th class="px-4 py-2 border">Data de Criação</th>
                                <th class="px-4 py-2 border">Última Atualização</th>
                                <th class="px-4 py-2 border">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unidades as $unidade)
                                <tr class="border text-gray-700 dark:text-gray-300 dark:border-gray-600">
                                    <td class="px-4 py-2 border">{{ $unidade->id }}</td>
                                    <td class="px-4 py-2 border">{{ $unidade->nome_fantasia }}</td>
                                    <td class="px-4 py-2 border">{{ $unidade->razao_social }}</td>
                                    <td class="px-4 py-2 border">
                                        {{ preg_replace("/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/", "$1.$2.$3/$4-$5", $unidade->cnpj) }}
                                    </td>
                                    <td class="px-4 py-2 border">{{ $unidade->bandeira->nome ?? 'Sem Bandeira' }}</td>
                                    <td class="px-4 py-2 border">{{ $unidade->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-2 border">{{ $unidade->updated_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-2 border flex gap-2">
                                        <a href="{{ route('unidades.edit', $unidade->id) }}" 
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg shadow-md transition-all">
                                            Editar
                                        </a>
                                        <form action="{{ route('unidades.destroy', $unidade->id) }}" method="POST"
                                              onsubmit="return confirm('Tem certeza que deseja excluir esta unidade?');">
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

                <!-- Paginação -->
                <div class="mt-4">
                    {{ $unidades->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
