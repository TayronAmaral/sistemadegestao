@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-xl font-bold mb-4">Relatório de Colaboradores</h2>

    <!-- Formulário de Filtro -->
    <form method="GET" action="{{ route('relatorios.colaboradores') }}" class="mb-6 bg-white p-4 rounded shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="unidade_id" class="block font-semibold">Unidade:</label>
                <select name="unidade_id" id="unidade_id" class="w-full border rounded p-2">
                    <option value="">Todas</option>
                    @foreach($unidades as $unidade)
                        <option value="{{ $unidade->id }}" {{ request('unidade_id') == $unidade->id ? 'selected' : '' }}>
                            {{ $unidade->nome_fantasia }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="email" class="block font-semibold">Email:</label>
                <input type="text" name="email" id="email" class="w-full border rounded p-2" value="{{ request('email') }}">
            </div>

            <div>
                <label for="cpf" class="block font-semibold">CPF:</label>
                <input type="text" name="cpf" id="cpf" class="w-full border rounded p-2" value="{{ request('cpf') }}">
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filtrar</button>
            <a href="{{ route('relatorios.colaboradores') }}" class="ml-2 text-gray-600">Limpar filtros</a>
        </div>
    </form>

    <!-- Botões de Exportação -->
    <div class="flex justify-end mb-4 space-x-2">
        <a href="{{ route('relatorios.colaboradores.export.excel') }}" 
           class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow-md transition-all">
            <i class="fas fa-file-excel"></i> Exportar para Excel
        </a>
        
        <a href="{{ route('relatorios.colaboradores.export.pdf') }}" 
           class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow-md transition-all">
            <i class="fas fa-file-pdf"></i> Exportar para PDF
        </a>
    </div>

    <!-- Tabela de Resultados -->
    <div class="bg-white p-4 rounded shadow-md">
        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-200">
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
                <tr class="border text-gray-700">
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

        <!-- Paginação -->
        <div class="mt-4">
            {{ $colaboradores->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection