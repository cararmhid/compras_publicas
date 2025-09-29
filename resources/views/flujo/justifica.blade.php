@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 10px">
    <h1>Justificar el Requerimiento</h1><br>

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
                    <form action="{{url('/flujos')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('get') }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="putch">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            @foreach($necesidads as $necesidad)
                                            <input type="hidden" name="nro_nec" value="{{$necesidad->nro_nec}}">
                                            <label for="">Justificativo</label><b>*</b>
                                            <textarea id="justific" rows="3" style="width: 100%;" name="justific">{{$necesidad->justific}}</textarea>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            @foreach($necesidads as $necesidad)
                                            <input type="hidden" name="nro_nec" value="{{$necesidad->nro_nec}}">
                                            <label for="">Forma de pago</label><b>*</b>
                                            <textarea id="forma_pago" rows="1" style="width: 100%;" name="forma_pago">{{$necesidad->forma_pago}}</textarea>
                                            @endforeach
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
                                    <button type="submit" name="boton1" value=7 class="btn btn-success">Guardar datos</button>
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