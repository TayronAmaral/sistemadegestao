@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Cabeçalho -->
        <header class="bg-white dark:bg-gray-800 shadow mb-6">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Relatório de Colaboradores
                </h2>
            </div>
        </header>

        <!-- Formulário de Filtro -->
        <form method="GET" action="{{ route('relatorios.colaboradores') }}" class="mb-6 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="unidade_id" class="block text-xl text-gray-900 dark:text-gray-100 font-bold mb-2">Unidade:</label>
                    <select name="unidade_id" id="unidade_id" class="w-full border rounded-lg p-3 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="">Todas</option>
                        @foreach($unidades as $unidade)
                            <option value="{{ $unidade->id }}" {{ request('unidade_id') == $unidade->id ? 'selected' : '' }}>
                                {{ $unidade->nome_fantasia }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="email" class="block text-xl text-gray-900 dark:text-gray-100 font-bold mb-2">Email:</label>
                    <input type="text" name="email" id="email" class="w-full border rounded-lg p-3 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100" value="{{ request('email') }}">
                </div>

                <div>
                    <label for="cpf" class="block text-xl text-gray-900 dark:text-gray-100 font-bold mb-2">CPF:</label>
                    <input type="text" name="cpf" id="cpf" class="w-full border rounded-lg p-3 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100" value="{{ request('cpf') }}">
                </div>
            </div>

            <div class="flex justify-between mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md transition-all">
                    Filtrar
                </button>
                <a href="{{ route('relatorios.colaboradores') }}" class="text-gray-600 dark:text-gray-300 hover:text-blue-500 mt-3 inline-block">
                    Limpar filtros
                </a>
            </div>
        </form>

        <!-- Botões de Exportação -->
        <div class="flex justify-end mb-6 space-x-4">
            <a href="{{ route('relatorios.colaboradores.export.excel') }}" 
                class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg shadow-md transition-all">
                <i class="fas fa-file-excel"></i> Exportar para Excel
            </a>
            
            <a href="{{ route('relatorios.colaboradores.export.pdf') }}" 
                class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg shadow-md transition-all">
                <i class="fas fa-file-pdf"></i> Exportar para PDF
            </a>
        </div>

        <!-- Tabela de Resultados -->
        <div class="bg-transparent p-4 rounded shadow-md">
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse">
                    <thead class="bg-gray-200 dark:bg-gray-700">
                        <tr class="text-gray-700 dark:text-gray-200">
                            <th class="border px-4 py-2">Nome</th>
                            <th class="border px-4 py-2">Email</th>
                            <th class="border px-4 py-2">CPF</th>
                            <th class="border px-4 py-2">Unidade</th>
                            <th class="border px-4 py-2">Bandeira</th>
                            <th class="border px-4 py-2">Grupo Econômico</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($colaboradores as $colaborador)
                            <tr class="border text-gray-700 dark:text-gray-300 dark:border-gray-600">
                                <td class="border px-4 py-2">{{ $colaborador->nome }}</td>
                                <td class="border px-4 py-2">{{ $colaborador->email }}</td>
                                <td class="border px-4 py-2">{{ preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $colaborador->cpf) }}</td>
                                <td class="border px-4 py-2">{{ $colaborador->unidade->nome_fantasia ?? 'Sem Unidade' }}</td>
                                <td class="border px-4 py-2">{{ $colaborador->unidade->bandeira->nome ?? 'N/A' }}</td>
                                <td class="border px-4 py-2">{{ $colaborador->unidade->bandeira->grupoEconomico->nome ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border text-center px-4 py-3">Nenhum colaborador encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginação -->
            <div class="mt-4">
                {{ $colaboradores->appends(request()->query())->links() }}
            </div>
        </div>

    </div>
</div>
@endsection
