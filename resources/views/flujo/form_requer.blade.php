@extends('layouts.admin')


@section('content')
<div class="content" style="margin-left: 10px">
        <h1>Formulario para realizar el Requerimiento</h1><br>

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

                                        
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Año</th>
                                                    <th>Partida</th>
                                                    <th>Cpc</th>
                                                    <th>Tipo de Compra</th>
                                                    <th>Descripción</th>
                                                    <th>Pc</th>
                                                    <th>Sc</th>
                                                    <th>Tc</th>
                                                    <th>Precio</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $contador = 0; @endphp
                                
                                                @foreach($pacs as $pac)
                                                    @php
                                                        $contador = $contador + 1;
                                                        $id = $pac->id;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $pac->año }}</td>
                                                        <td>{{ $pac->partida }}</td>
                                                        <td>{{ $pac->cpc }}</td>
                                                        <td>{{ $pac->tip_comp }}</td>
                                                        <td>{{ $pac->descripcion }}</td>
                                                        <td>{{ $pac->pc }}</td>
                                                        <td>{{ $pac->sc }}</td>
                                                        <td>{{ $pac->tc }}</td>
                                                        <td>{{ $pac->precio }}</td>
                                                     
                                                        <td>
                                                            <td style="text-align: center;">
                                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                                    <!--<button type="submit" name="boton1" value=5 class="btn btn-success">Justificar</button>-->
                                                                    <a href="{{url('/flujos',$pac->id)}}" type="button" class="btn btn-secondary"><i class="bi bi-pencil"></i></a>
                                      
                                                                </div>
                                                            </td>
                                
                                   
                                
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        
                                   
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        
                                        <button type="submit" class="btn btn-secondary" name='boton1' value=0>Cancelar</button>
                                        <button type="submit" name="boton1" value=4 class="btn btn-primary">Generar Orden de Requerimiento PDF</button>
                                        <button type="submit" name="boton1" value=6 class="btn btn-primary">Genera Memorando</button>
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

<script>
    $(document).ready(function() {
        $('#id_proceso').change(function() {
            var pacId = $(this).val();
            if (pacId) {
                $.ajax({
                    url: '/get-price/' + pacId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#precio').val(data.precio);
                    }
                });
            } else {
                $('#precio').val('');
            }
        });
    });
</script>