@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 text-center">Editar Perfil</h2>

    <form action="{{ route('profile.update') }}" method="POST" class="mt-6 space-y-4">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            
            <div>
                <label for="name" class="block text-gray-700 dark:text-gray-300 font-medium">Nome:</label>
                <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" required
                    class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white 
                    focus:ring-2 focus:ring-blue-400 focus:border-blue-500 transition duration-200 outline-none">
            </div>
           
            <div>
                <label for="email" class="block text-gray-700 dark:text-gray-300 font-medium">E-mail:</label>
                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" required 
                    class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white 
                    focus:ring-2 focus:ring-blue-400 focus:border-blue-500 transition duration-200 outline-none">
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md shadow-md transition duration-200">
                Salvar
            </button>
        </div>
    </form>
</div>
@endsection
