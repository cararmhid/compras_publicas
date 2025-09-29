@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 10px">
    <h1>Solicita Certificación POA</h1><br>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos</b></h3>
                    </div>
                    <div class="card-body" style="display: block;">
                        <form action="{{route('solicituds.store',)}}" method="post" enctype="multipart/form-data">
                            @csrf
                

                            <div class="row">
                                <div class="col-md-12   ">
                                    <div class="row">

                                        <div class="col-md-3" class="form-group" >
                                            <label for="id_proceso">Tipo de Compra</label>
                                            <select class="form-control" id="tip_comp" name="tip_comp" required>
                                                <option value="" disabled selected>Seleccione el Tipo de compra</option>
                                                @foreach($options as $option)
                                                    <option value="{{ $option }}">{{ $option }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3" class="form-group" >
                                            <label for="id_proceso">Tipo de Proceso</label>
                                            <select class="form-control" id="tipo_flujo" name="tipo_flujo" required>
                                                <option value="" disabled selected>Seleccione el Tipo de Proceso</option>
                                                @foreach($presups as $presup)
                                                    <option value="{{ $presup }}">{{ $presup }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                                                               
                                        <div class="col-md-3" class="form-group" >
                                    <div class="col-md-12">
                                        <br>
                                        <br>
                                        <a href="{{url('/solicituds')}}" class="btn btn-secondary">Cancelar</a>
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
