@extends('layouts.admin')


@section('content')
    <div class="content" style="margin-left: 10px">
        <h1>Datos del formato</h1><br>


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
                                                <label for="">Orden</label>
                                                <input type="text" name="orden" value="{{$flujo1s->orden}}" class="form-control" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Dpto</label>
                                                <input type="text" name="dpto" value="{{$flujo1s->dpto}}" class="form-control" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Descripción</label>
                                                <textarea id="descripcion" rows="3" style="width: 100%;" name="descripcion" disabled> {{$flujo1s->descripcion}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Id Usuario</label>
                                                <input type="text" name="id_user" value="{{$flujo1s->id_user}}" class="form-control" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">tiempo</label>
                                                <input type="text" name="tiempo" value="{{$flujo1s->tiempo}}" class="form-control" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">formulario</label>
                                                <input type="text" name="formulario" value="{{$flujo1s->formulario}}" class="form-control" disabled>
                                            </div>
                                        </div>

                                       </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                     <a href="{{url('flujo1s')}}" class="btn btn-secondary">Regresar</a>

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

