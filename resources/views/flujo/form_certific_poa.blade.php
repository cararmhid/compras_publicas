@extends('layouts.admin')


@section('content')
<div class="content" style="margin-left: 10px">
        <h1>Formulario para Certificación del POA</h1><br>

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
                                                <label for="">Meta</label><b>*</b>
                                                 <textarea id="meta" class="form-control" rows="3" style="width: 100%;" name="meta" disabled> {{session('meta')}} </textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="dpto">Dirección</label>
                                                <input type="text" id="direcc" class="form-control" name="direcc" value="{{ session('direcc') }}" style="width: 100%;" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="dpto">Departamento</label>
                                                <input type="text" id="dpto" class="form-control" name="dpto" value="{{ session('dpto') }}" style="width: 100%;" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="dpto">Fecha Inicial</label>
                                                <input type="text" id="fecha_ini" class="form-control" name="fecha_ini" value="{{ session('fecha_ini') }}" style="width: 100%;" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="dpto">Fecha Final</label>
                                                <input type="text" id="fecha_fin" class="form-control" name="fecha_fin" value="{{ session('fecha_fin') }}" style="width: 100%;" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="dpto">Valor</label>
                                                <input type="text" id="valor" class="form-control" name="valor" value="{{ session('valor') }}" style="width: 100%;" readonly>
                                            </div>
                                        </div>
                                  
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
                                        <button type="submit" class="btn btn-primary" name='boton1' value=3>Generar PDF Cert. POA</button>
                                        <button type="submit" class="btn btn-success" name='boton1' value=1>Regresar Trámite</button>
                                        <button type="submit" class="btn btn-success" name='boton1' value=2>Continuar Trámite</button>
                                       
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

