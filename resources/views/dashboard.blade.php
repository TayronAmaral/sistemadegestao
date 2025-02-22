@extends('layouts.app')

@section('content')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Sistema de Gestão') }}
            </h2>
        </div>
    </header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Seja Bem vindo!") }}
                </div>
            </div>
        </div>
    </div>

    <!-- Botão para acessar os Grupos Economicos -->
    <div class="bg-white dark:bg-gray-800 mt-6 p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Gerenciar Grupos</h3>
        <a href="{{ route('grupos.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            Ver Grupos
        </a>
        <br><br>
        <a href="{{ route('grupos.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">
            Adicionar Novos Grupos
        </a>
    </div>

    <!-- Botão para acessar as Bandeiras -->
    <div class="bg-white dark:bg-gray-800 mt-6 p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Gerenciar Bandeiras</h3>
        <a href="{{ route('bandeiras.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            Ver Bandeiras
        </a>
        <br><br>
        <a href="{{ route('bandeiras.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">
            Adicionar Nova Bandeira
        </a>
    </div>

    <!-- Botão para acessar as Unidades -->
    <div class="bg-white dark:bg-gray-800 mt-6 p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Gerenciar Unidades</h3>
        <a href="{{ route('unidades.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            Ver Unidades
        </a>
        <br><br>
        <a href="{{ route('unidades.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">
            Adicionar Nova Unidade
        </a>
    </div>

    <!-- Botão para acessar os Colaboradores -->
    <div class="bg-white dark:bg-gray-800 mt-6 p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Gerenciar Colaboradores</h3>
        <a href="{{ route('colaboradores.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            Ver Colaboradores
        </a>
        <br><br>
        <a href="{{ route('colaboradores.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">
            Adicionar Novo Colaborador
        </a>
    </div>

    <!-- Formulário para adicionar um novo usuário -->
    <div class="bg-white dark:bg-gray-800 mt-6 p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Adicionar Usuário</h3>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Nome:</label>
                <input type="text" name="name" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">E-mail:</label>
                <input type="email" name="email" class="w-full p-2 border rounded" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Salvar</button>
        </form>
    </div>

    <!-- Tabela de usuários -->
    <div class="bg-white dark:bg-gray-800 mt-6 p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Lista de Usuários</h3>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Nome</th>
                    <th class="border border-gray-300 px-4 py-2">E-mail</th>
                    <th class="border border-gray-300 px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="border border-gray-300">
                        <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Editar</a>

                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
