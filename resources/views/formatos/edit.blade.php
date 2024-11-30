@extends('layouts.admin')


@section('content')
  <form action="/formatos/{{$formato->id}}" method="POST">
      @csrf    
      @method('PUT')
    <div class="mb-3">
      <label for="" class="form-label">Descripción</label>
      <input id="descripcion" name="descripcion" type="text" class="form-control" value="{{$formato->descripcion}}">
    </div>
    <div class="mb-3">
      <label for="" class="form-label">Url</label>
      <input id="url" name="url" type="file" class="form-control" value="{{$formato->url}}">
    </div>
    <a href="/formatos" class="btn btn-secondary">Cancelar</a>
    <button type="submit" class="btn btn-primary">Guardar</button>
  </form>
@stop

