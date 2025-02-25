@extends('layouts.app')

@section('header')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Editar Colaborador
            </h2>
        </div>
    </header>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                {{-- Exibição de erros de validação --}}
                @if ($errors->any())
                    <div class="bg-red-500 text-white p-3 rounded-lg mb-4 shadow-md">
                        <strong>Erro!</strong> Corrija os problemas abaixo:
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Formulário de edição --}}
                <form action="{{ route('colaboradores.update', $colaborador->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nome" class="block text-gray-700 dark:text-gray-300">Nome</label>
                        <input type="text" name="nome" id="nome"
                               class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               value="{{ old('nome', $colaborador->nome) }}" required>
                    </div>

                    <div>
                        <label for="email" class="block text-gray-700 dark:text-gray-300">E-mail</label>
                        <input type="email" name="email" id="email"
                               class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               value="{{ old('email', $colaborador->email) }}" required>
                    </div>

                    <div>
                        <label for="cpf" class="block text-gray-700 dark:text-gray-300">CPF</label>
                        <input type="text" name="cpf" id="cpf"
                               class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white cpf-mask"
                               value="{{ old('cpf', $colaborador->cpf) }}" required>
                    </div>

                    <div>
                        <label for="unidade_id" class="block text-gray-700 dark:text-gray-300">Unidade</label>
                        <select name="unidade_id" id="unidade_id"
                                class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            <option value="">Selecione uma unidade</option>
                            @foreach($unidades as $unidade)
                                <option value="{{ $unidade->id }}" 
                                    {{ old('unidade_id', $colaborador->unidade_id) == $unidade->id ? 'selected' : '' }} >
                                    {{ $unidade->nome_fantasia }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                            Atualizar Colaborador
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mask-plugin/1.14.15/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.cpf-mask').mask('000.000.000-00', {reverse: true});
        });
    </script>
@endpush
