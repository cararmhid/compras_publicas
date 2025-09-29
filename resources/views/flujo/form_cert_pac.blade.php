@extends('layouts.admin')


@section('content')
<div class="content" style="margin-left: 10px">
        <h1>Formulario para dar continuidad al trámite</h1><br>

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
                        <form action="{{url('/flujos',$flujos->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                           {{method_field('PUT')}}
                            <div class="row">
                                <div class="col-md-12   ">
                                    <div class="row">

 
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Observación</label><b> Digite en caso de regresar el trámite</b>
                                                <textarea id="observaciones" rows="3" style="width: 100%;" name="observaciones"> {{$flujos->observaciones}}</textarea>
                                            </div>
                                        </div>

  
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        
                                        <button type="submit" class="btn btn-secondary" name='boton1' value=0>Cancelar</button>
                                        <button type="submit" class="btn btn-primary" name='boton1' value=9>Certificacón PAC</button>
                                        <button type="submit" class="btn btn-primary" name='boton1' value=10>Certificacón CE</button>
                                        <button type="submit" class="btn btn-primary" name='boton1' value=11>Cuadro Comparativo</button>
                                                         
                                        @if ($flujos->orden == 10)
                                            <button type="submit" class="btn btn-success" name='boton1' value="1">Regresar Trámite</button>
                                        @endif
                                        <button type="submit" class="btn btn-success" name='boton1' value=16>Continuar Trámite</button>
                                        
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
