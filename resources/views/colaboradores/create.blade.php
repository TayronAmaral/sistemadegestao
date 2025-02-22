@extends('layouts.app')

@section('header')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Novo Colaborador
            </h2>
        </div>
    </header>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                
                <form action="{{ route('colaboradores.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="nome" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Nome:</label>
                        <input type="text" name="nome" id="nome" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring focus:ring-blue-300 px-4 py-2" value="{{ old('nome') }}" required>
                        @error('nome')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">E-mail:</label>
                        <input type="email" name="email" id="email" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring focus:ring-blue-300 px-4 py-2" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="cpf" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">CPF:</label>
                        <input type="text" name="cpf" id="cpf" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring focus:ring-blue-300 px-4 py-2" value="{{ old('cpf') }}" required>
                        @error('cpf')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="unidade_id" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Unidade:</label>
                        <select name="unidade_id" id="unidade_id" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring focus:ring-blue-300 px-4 py-2" required>
                            <option value="" disabled selected>Selecione uma Unidade</option>
                            @foreach($unidades as $unidade)
                                <option value="{{ $unidade->id }}" {{ old('unidade_id') == $unidade->id ? 'selected' : '' }}>
                                    {{ $unidade->nome_fantasia }}
                                </option>
                            @endforeach
                        </select>
                        @error('unidade_id')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('colaboradores.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                            Salvar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mask-plugin/1.14.15/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#cpf').mask('000.000.000-00');
        });
    </script>
@endpush
