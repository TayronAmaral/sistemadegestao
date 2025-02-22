@extends('layouts.app')

@section('header')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Editar Unidade
            </h2>
        </div>
    </header>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <!-- Formulário de edição da unidade -->
                <form action="{{ route('unidades.update', $unidade->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT') <!-- Método PUT para atualizar o registro -->

                    <div>
                        <label for="nome_fantasia" class="block text-gray-700 dark:text-gray-300">Nome Fantasia</label>
                        <input type="text" name="nome_fantasia" id="nome_fantasia"
                               class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               value="{{ old('nome_fantasia', $unidade->nome_fantasia) }}" required>
                    </div>

                    <div>
                        <label for="razao_social" class="block text-gray-700 dark:text-gray-300">Razão Social</label>
                        <input type="text" name="razao_social" id="razao_social"
                               class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               value="{{ old('razao_social', $unidade->razao_social) }}" required>
                    </div>

                    <div>
                        <label for="cnpj" class="block text-gray-700 dark:text-gray-300">CNPJ</label>
                        <input type="text" name="cnpj" id="cnpj"
                               class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               value="{{ old('cnpj', $unidade->cnpj) }}" required>
                    </div>

                    <div>
                        <label for="bandeira_id" class="block text-gray-700 dark:text-gray-300">Bandeira</label>
                        <select name="bandeira_id" id="bandeira_id"
                                class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            @foreach ($bandeiras as $bandeira)
                                <option value="{{ $bandeira->id }}" 
                                    {{ $unidade->bandeira_id == $bandeira->id ? 'selected' : '' }}>
                                    {{ $bandeira->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                            Atualizar Unidade
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
