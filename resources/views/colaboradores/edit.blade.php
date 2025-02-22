@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Editar Colaborador</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erro!</strong> Corrija os problemas abaixo:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('colaborador.update', $colaborador->id) }}" method="POST">


        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" 
                   value="{{ old('nome', $colaborador->nome) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" 
                   value="{{ old('email', $colaborador->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" class="form-control cpf-mask" id="cpf" name="cpf" 
                   value="{{ old('cpf', $colaborador->cpf) }}" required>
        </div>

        <div class="mb-3">
            <label for="unidade_id" class="form-label">Unidade</label>
            <select class="form-control" id="unidade_id" name="unidade_id" required>
                <option value="">Selecione uma unidade</option>
                @foreach($unidades as $unidade)
                    <option value="{{ $unidade->id }}" 
                        {{ old('unidade_id', $colaborador->unidade_id) == $unidade->id ? 'selected' : '' }}>
                        {{ $unidade->nome }} 
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('colaboradores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mask-plugin/1.14.15/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.cpf-mask').mask('000.000.000-00', {reverse: true});
        });
    </script>
@endpush

@endsection
