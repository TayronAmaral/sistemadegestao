@extends('layouts.app')

@section('header')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Editar Grupo Econômico
            </h2>
        </div>
    </header>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <form action="{{ route('grupos.update', $grupo->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-gray-900 dark:text-gray-100 font-medium">Nome do Grupo:</label>
                        <input type="text" name="nome" value="{{ old('nome', $grupo->nome) }}"
                               class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                               placeholder="Digite o nome do grupo..." required>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('grupos.index') }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition-all">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition-all">
                            Atualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
