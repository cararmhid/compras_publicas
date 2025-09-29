@extends('layouts.admin')

@section('content')

<div class="content" style="margin-left: 10px">
    <h1>Actualización del PAC</h1><br>


        @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            <li>{{$error}}</li>
        </div>
        @endforeach


    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title"><b>Llene los datos</b></h3>
                </div>
                <div class="card-body" style="display: block;">
                     <form action="{{ route('poas.update', $poa->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                            
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Meta</label><b>*</b>
                                            <textarea id="meta" class="form-control" rows="3" style="width: 100%;" name="meta"> {{$poa->meta}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="id_direcc">Dirección</label>
                                        <select class="form-control" id="id_direcc" name="id_direcc" required>
                                            <option value="" disabled selected>Seleccione la Dirección</option>
                                            @foreach($direccions as $direccion)
                                                <option value="{{ $direccion->id }}" {{ $direccion->id == $poa->id_direcc ? 'selected' : '' }}>
                                                    {{ $direccion->direcc }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="id_dpto">Departamento</label>
                                        <select class="form-control" id="id_dpto" name="id_dpto" required>
                                            <option value="" disabled selected>Seleccione el Departamento</option>
                                            @foreach($depars as $depar)
                                                <option value="{{ $depar->id }}" {{ $depar->id == $poa->id_dpto ? 'selected' : '' }}>
                                                    {{ $depar->dpto }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                   
                                    <div class="col-md-3" class="form-group" >
                                        <label for="fecha_ini">Fecha Inicio</label>
                                        <input type="text" class="form-control" id="fecha_ini" name="fecha_ini" value ="{{$poa->fecha_ini}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_fin">Fecha Fin</label>
                                        <input type="text" class="form-control" id="fecha_fin" name="fecha_fin" value ="{{$poa->fecha_fin}}" required>
                                    </div>
                                    <div class="col-md-6" class="form-group">
                                        <label for="valor">Valor</label>
                                        <input type="decimal" class="form-control" id="valor" name="valor" value ="{{$poa->valor}}" required>
                                         <br>
                                    </div>
                                    <div class="col-md-12">
                                        <a href="{{url('/pacs')}}" class="btn btn-secondary">Cancelar</a>
                               
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

@endsection


