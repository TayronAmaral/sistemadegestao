@extends('layouts.app')

@section('header')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Editar Bandeira
            </h2>
        </div>
    </header>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                
                <form action="{{ route('bandeiras.update', $bandeira->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="nome" class="block text-gray-700 dark:text-gray-300">Nome:</label>
                        <input type="text" id="nome" name="nome" 
                               value="{{ old('nome', $bandeira->nome) }}" 
                               class="w-full p-2 border rounded dark:bg-gray-700 dark:text-white" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="grupo_economico_id" class="block text-gray-700 dark:text-gray-300">
                            Grupo Econômico:
                        </label>
                        <select id="grupo_economico_id" name="grupo_economico_id" 
                                class="w-full p-2 border rounded dark:bg-gray-700 dark:text-white" required>
                            @foreach($grupoEconomicos as $grupo)
                                <option value="{{ $grupo->id }}" 
                                    {{ $bandeira->grupo_economico_id == $grupo->id ? 'selected' : '' }}>
                                    {{ $grupo->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                            Atualizar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
