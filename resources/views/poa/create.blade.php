@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 10px">
    <h1>Creación de un nuevo Poa</h1><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos</b></h3>
                    </div>
                    <div class="card-body" style="display: block;">
                        <form action="{{route('poas.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12   ">
                                    <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Meta</label><b>*</b>
                                            <textarea id="meta" class="form-control" rows="3" style="width: 100%;" name="meta"> {{old('meta')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6" class="form-group" >
                                        <label for="id_direcc">Dirección</label>
                                        <select class="form-control" id="id_direcc" name="id_direcc" required>
                                            <option value="" disabled selected>Seleccione la Dirección</option>
                                            @foreach($direccions as $direccion)
                                                <option value="{{ $direccion->id }}">{{ $direccion->direcc }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6" class="form-group">
                                        <label for="id_dpto">Departamento</label>
                                        <select class="form-control" id="id_dpto" name="id_dpto" required>
                                            <option value="" disabled selected>Seleccione el Departamento</option>
                                            @foreach($depars as $depar)
                                                <option value="{{ $depar->id }}">{{ $depar->dpto }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                   
                                    <div class="col-md-3" class="form-group" >
                                        <label for="fecha_ini">Fecha Inicio</label>
                                        <input type="text" class="form-control" id="fecha_ini" name="fecha_ini" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_fin">Fecha Fin</label>
                                        <input type="text" class="form-control" id="fecha_fin" name="fecha_fin" required>
                                    </div>
                                    <div class="col-md-6" class="form-group">
                                        <label for="valor">Valor</label>
                                        <input type="decimal" class="form-control" id="valor" name="valor" required>
                                         <br>
                                    </div>
                                    <div class="col-md-12">
                                        <a href="{{url('/poas')}}" class="btn btn-secondary">Cancelar</a>
                               
                                        <button type="submit" class="btn btn-primary">    Guardar    </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
