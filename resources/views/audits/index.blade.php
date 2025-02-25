@extends('layouts.app')

@section('header')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Histórico de Auditoria
            </h2>
        </div>
    </header>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">

                <!-- Título -->
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Registros de Auditoria</h3>   

                <!-- Tabela com os registros de auditoria -->
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-200 dark:border-gray-700 text-sm">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-white text-left">
                                <th class="px-4 py-2 border">ID</th>
                                <th class="px-4 py-2 border">Usuário</th>
                                <th class="px-4 py-2 border">Ação</th>
                                <th class="px-4 py-2 border">Data</th>
                                <th class="px-4 py-2 border text-center">Detalhes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($audits as $audit)
                                <tr class="border text-gray-700 dark:text-gray-300 dark:border-gray-600">
                                    <td class="px-4 py-2 border whitespace-nowrap">{{ $audit->id }}</td>
                                    <td class="px-4 py-2 border whitespace-nowrap">{{ $audit->user->name ?? 'Sistema' }}</td>
                                    <td class="px-4 py-2 border whitespace-nowrap">{{ ucfirst($audit->event) }}</td>
                                    <td class="px-4 py-2 border whitespace-nowrap">{{ $audit->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        <a href="{{ route('audits.show', $audit->id) }}" 
                                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg shadow-md transition-all">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-3 text-center text-gray-600 dark:text-gray-300">
                                        Nenhum registro de auditoria encontrado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginação -->
                <div class="mt-4">
                    {{ $audits->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
