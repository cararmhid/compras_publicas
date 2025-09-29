@extends('layouts.admin')


@section('content')
    <div class="content" style="margin-left: 10px">
        <h1>Datos de las Direcciones</h1><br>


            @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                <li>{{$error}}</li>
            </div>
            @endforeach


        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-secondary    ">
                    <div class="card-header">
                        <h3 class="card-title"><b>Datos registrados</b></h3>
                    </div>
                    <div class="card-body" style="...">
                            <div class="row">
                                <div class="col-md-12   ">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nro. Secuencia</label>
                                                <input type="text" name="nro_sec" value="{{$direcciones->nro_sec}}" class="form-control" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Dirección</label>
                                                <input type="text" name="direcc" value="{{$direcciones->direcc}}" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Abreviatura</label>
                                                <input type="text" name="iniciales" value="{{$direcciones->iniciales}}" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Responsable</label>
                                                <input type="text" name="responsable" value="{{$direcciones->responsable}}" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Id. Usuario</label>
                                                <input type="text" name="id_user" value="{{$direcciones->id_user}}" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Cargo</label>
                                                <input type="text" name="cargo" value="{{$direcciones->cargo}}" class="form-control" disabled>
                                            </div>
                                        </div>

 
                                       </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                     <a href="{{url('direccions')}}" class="btn btn-secondary">Regresar</a>

                                   <!-- <button id="back-button" class="btn btn-secondary mb-3">Regresar</button>-->
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
@endsection

