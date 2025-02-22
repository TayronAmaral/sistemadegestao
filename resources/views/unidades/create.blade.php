@extends('layouts.app')

@section('header')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Criar Unidade
            </h2>
        </div>
    </header>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <!-- Formulário para criar unidade -->
                <form action="{{ route('unidades.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="nome_fantasia" class="block text-gray-700 dark:text-gray-300">Nome Fantasia</label>
                        <input type="text" name="nome_fantasia" id="nome_fantasia"
                               class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               value="{{ old('nome_fantasia') }}" required>
                        @error('nome_fantasia')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="razao_social" class="block text-gray-700 dark:text-gray-300">Razão Social</label>
                        <input type="text" name="razao_social" id="razao_social"
                               class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               value="{{ old('razao_social') }}" required>
                        @error('razao_social')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="cnpj" class="block text-gray-700 dark:text-gray-300">CNPJ</label>
                        <input type="text" name="cnpj" id="cnpj"
                               class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               value="{{ old('cnpj') }}" required>
                        @error('cnpj')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="bandeira_id" class="block text-gray-700 dark:text-gray-300">Bandeira</label>
                        <select name="bandeira_id" id="bandeira_id"
                                class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            <option value="">Selecione uma Bandeira</option>
                            @foreach($bandeiras as $bandeira)
                                <option value="{{ $bandeira->id }}" {{ old('bandeira_id') == $bandeira->id ? 'selected' : '' }}>
                                    {{ $bandeira->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('bandeira_id')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                            Criar Unidade
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Máscara para CNPJ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mask-plugin/1.14.15/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#cnpj').mask('00.000.000/0000-00');
        });
    </script>
@endpush
