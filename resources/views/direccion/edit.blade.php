@extends('layouts.admin')


@section('content')
<div class="content" style="margin-left: 10px">
        <h1>Actualización del archivo</h1><br>


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
                        <form action="{{url('/direcciones',$direccions->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{method_field('PATCH')}}
                            <div class="row">
                                <div class="col-md-12   ">
                                    <div class="row">

                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nro. de Secuencia</label><b>*</b>
                                                <input type="text" name="nro_sec" value="{{$direccions->nro_sec}}" class="form-control" required>
                                            </div>
                                        </div>
  
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Dirección</label><b>*</b>
                                                <input type="text" name="direcc" value="{{$direccions->direcc}}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Abreviatura de la Dirección</label><b>*</b>
                                                <input type="text" name="iniciales" value="{{$direccions->iniciales}}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Responsable</label><b>*</b>
                                                <input type="text" name="responsable" value="{{$direccions->responsable}}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Id Usuario</label><b>*</b>
                                                <input type="text" name="id_user" value="{{$direccions->id_user}}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Cargo</label><b>*</b>
                                                <input type="text" name="cargo" value="{{$direccions->cargo}}" class="form-control" required>
                                            </div>
                                        </div>
  
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <a href="{{url('/direcciones')}}" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-success">Actualizar registro</button>
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

