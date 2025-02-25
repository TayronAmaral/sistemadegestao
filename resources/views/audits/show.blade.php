@extends('layouts.app')

@section('header')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-2xl text-gray-900 dark:text-gray-100 leading-tight">
                Detalhes da Auditoria
            </h2>
        </div>
    </header>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">

                <!-- Título -->
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Registro de Auditoria #{{ $audit->id }}</h3>

                <!-- Detalhes da Auditoria -->
                <div class="mb-4 text-gray-900 dark:text-gray-200">
                    <p><strong>Usuário:</strong> {{ $audit->user ? $audit->user->name : 'N/A' }}</p>
                    <p><strong>Ação:</strong> {{ ucfirst($audit->event) }}</p>
                    <p><strong>Data:</strong> {{ $audit->created_at->format('d/m/Y H:i:s') }}</p>
                </div>

                <!-- Valores Antigos -->
                <div class="mb-4">
                    <h5 class="text-lg font-bold text-gray-900 dark:text-gray-100">Valores Antigos</h5>
                    <pre class="bg-gray-200 dark:bg-gray-700 text-sm p-4 rounded-lg text-gray-900 dark:text-gray-100">{{ json_encode($audit->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                </div>

                <!-- Valores Novos -->
                <div class="mb-4">
                    <h5 class="text-lg font-bold text-gray-900 dark:text-gray-100">Valores Novos</h5>
                    <pre class="bg-gray-200 dark:bg-gray-700 text-sm p-4 rounded-lg text-gray-900 dark:text-gray-100">{{ json_encode($audit->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                </div>

                <!-- Botão de Voltar -->
                <a href="{{ route('audits.index') }}" 
                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>

            </div>
        </div>
    </div>
@endsection
