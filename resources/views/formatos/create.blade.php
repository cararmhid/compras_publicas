@extends('layouts.admin')


@section('content')
    <form action="/formatos" method="POST">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Descripción</label>
            <input id="descripcion" name="descripcion" type="text" class="form-control" tabindex="2">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Url</label>
            <input id="url" name="url" type="file" class="form-control" tabindex="3">
        </div>
        <a href="/formatos" class="btn btn-secondary" tabindex="5">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
    </form>
@stop

