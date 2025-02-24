@extends('layouts.app')

@section('header')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Lista de Colaboradores
            </h2>
        </div>
    </header>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">

                <!-- Título da Lista de Colaboradores -->
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Lista de Colaboradores</h3>   

                <!-- Botões de Ação -->
                <div class="flex justify-end space-x-2 mb-4">
                    <a href="{{ route('colaboradores.create') }}" 
                       class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                        <i class="fas fa-user-plus"></i> Novo Colaborador
                    </a>
                    <a href="{{ route('relatorios.colaboradores') }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                        <i class="fas fa-file-alt"></i> Relatórios
                    </a>
                </div>

                <!-- Tabela com os Colaboradores -->
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-200 dark:border-gray-700 text-sm">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-white text-left">
                                <th class="px-4 py-2 border">Nome</th>
                                <th class="px-4 py-2 border">E-mail</th>
                                <th class="px-4 py-2 border">CPF</th>
                                <th class="px-4 py-2 border">Unidade</th>
                                <th class="px-4 py-2 border text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($colaboradores as $colaborador)
                                <tr class="border text-gray-700 dark:text-gray-300 dark:border-gray-600">
                                    <td class="px-4 py-2 border whitespace-nowrap">{{ $colaborador->nome }}</td>
                                    <td class="px-4 py-2 border whitespace-nowrap">{{ $colaborador->email }}</td>
                                    <td class="px-4 py-2 border whitespace-nowrap">{{ $colaborador->cpf }}</td>
                                    <td class="px-4 py-2 border whitespace-nowrap">{{ $colaborador->unidade->nome_fantasia ?? 'Sem Unidade' }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('colaboradores.edit', $colaborador) }}" 
                                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg shadow-md transition-all">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <form action="{{ route('colaboradores.destroy', $colaborador->id) }}" method="POST"
                                                  onsubmit="return confirmDelete();" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg shadow-md transition-all">
                                                    <i class="fas fa-trash"></i> Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-3 text-center text-gray-600 dark:text-gray-300">
                                        Nenhum colaborador cadastrado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginação -->
                <div class="mt-4">
                    {{ $colaboradores->links() }}
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmDelete() {
                return confirm('Tem certeza que deseja excluir este colaborador? Essa ação não pode ser desfeita.');
            }
        </script>
    @endpush
@endsection
