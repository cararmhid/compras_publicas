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
                        <form action="{{url('/flujo4s',$flujo4s->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{method_field('PATCH')}}
                            <div class="row">
                                <div class="col-md-12   ">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Orden</label><b>*</b>
                                                <input type="text" name="orden" value="{{$flujo4s->orden}}" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Dpto</label><b>*</b>
                                                <input type="text" name="dpto" value="{{$flujo4s->dpto}}" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Descripción</label><b>*</b>
                                                <textarea id="descripcion" rows="3" style="width: 100%;" name="descripcion"> {{$flujo4s->descripcion}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Id_User</label><b>*</b>
                                                <input type="text" name="id_user" value="{{$flujo4s->id_user}}" class="form-control" required>
                                            </div>
                                        </div>
                                     
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Tiempo</label><b>*</b>
                                                <input type="text" name="tiempo" value="{{$flujo4s->tiempo}}" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Formulario</label><b>*</b>
                                                <input type="text" name="formulario" value="{{$flujo4s->formulario}}" class="form-control" required>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <a href="{{url('/flujo4s')}}" class="btn btn-secondary">Cancelar</a>
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

