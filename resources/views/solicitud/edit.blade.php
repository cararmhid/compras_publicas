@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 10px">
    <h1>Solicitar Certificación POA</h1><br>

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
                    <form action="{{url('/solicituds', $poas->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{method_field('PATCH')}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label for="tip_comp">Tipo de Compra</label>
                                        <select class="form-control" id="tip_comp" name="tip_comp" required>
                                            <option value="" disabled selected>Seleccione el Tipo de Compra</option>
                                            @foreach($options as $option)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="tipo_flujo">Tipo de Proceso</label>
                                        <select class="form-control" id="tipo_flujo" name="tipo_flujo" required>
                                            <option value="" disabled selected>Seleccione el Tipo de Proceso</option>
                                            @foreach($presups as $presup)
                                                <option value="{{ $presup }}">{{ $presup }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <a href="{{url('/solicituds')}}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Guardar Solicitud</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection