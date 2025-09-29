@extends('layouts.admin')

@section('content')
<div class="content" style="margin: 10px;">
    <h1 style="color: #030a03;">Designar el Administrador del Proceso</h1><br>

    @foreach($errors->all() as $error)
    <div class="alert alert-danger" style="margin-bottom: 10px;">
        <li>{{ $error }}</li>
    </div>
    @endforeach

    <form action="{{ route('ruta.guardaradm') }}" method="POST" style="background-color: #f9f9f9; padding: 20px; border-radius: 5px;">
        @csrf
        <!-- Campo de selección de usuarios -->
        <div class="form-group">
            <label for="user_id" style="font-weight: bold;">Seleccionar Usuario:</label>
            <select name="user_id" id="user_id" class="form-control" style="margin-bottom: 20px;">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Botones de Guardar y Cancelar -->
        <button type="submit" class="btn btn-success" style="margin-right: 10px;">Guardar</button>
        <button type="button" class="btn btn-secondary" onclick="window.location='{{ url('/flujos') }}'">Cancelar</button>
    </form>
</div>
@endsection