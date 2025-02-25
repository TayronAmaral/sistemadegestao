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
                    <h3 class="text-2xl font-bold">Sobre o Projeto</h3>
                    <p class="mt-4">Este sistema foi desenvolvido como um teste prático para desenvolvedores Full Stack. 
                    O objetivo é gerenciar um grupo econômico que possui várias bandeiras, unidades e colaboradores. </p>
                    <p class="mt-4">As principais funcionalidades incluem:</p>
                    <ul class="list-disc list-inside mt-2">
                        <li>Gerenciamento de Grupos Econômicos</li>
                        <li>Administração de Bandeiras e Unidades</li>
                        <li>Cadastro e controle de Colaboradores</li>
                        <li>Geração de Relatórios detalhados</li>
                        <li>Registro de Auditoria</li>
                        <li>Autenticação e Controle de Acesso</li>
                        <li>Exportação de dados para Excel e PDF</li>
                    </ul>
                    <p class="mt-4">O projeto foi desenvolvido utilizando Laravel 10 e MySQL, com suporte a funcionalidades avançadas como Livewire, testes unitários e processamento assíncrono via filas.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
