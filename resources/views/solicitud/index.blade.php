@extends('layouts.admin')

@section('content')


<div class="content" style="margin-left: 20px">
    <h1>POA de su Unidad</h1>

    @if($message = Session::get('mensaje'))
        <script>
            Swal.fire({
                title: "Buen trabajo",
                text: "{{$message}}",
                icon: "success"
            });
        </script>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>POAS</b></h3>
                    <div class="card-tools">
                        
                      <!--  <a href="{{url('solicituds/create')}}" class="btn btn-primary">
                            <i class="bi bi-file-plus"></i> Crea un nuevo Poa
                        </a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button> -->  
                    </div>
                </div>
                <div class="card-body" style="display: block;">

  
        <table class="table">
            <thead>
                <tr>
                    <th>Meta</th>
                    <th>Dirección</th>
                    <th>Departamento</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Valor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php $contador = 0; @endphp

                @foreach($poas as $poa)
                    @php
                        $contador = $contador + 1;
                        $id = $poa->id;
                    @endphp
                    <tr>
                        <td>{{ $poa->meta }}</td>
                        <td>{{ $poa->direccion->direcc }}</td>
                        <td>{{ $poa->depar->dpto }}</td>
                        <td>{{ $poa->fecha_ini }}</td>
                        <td>{{ $poa->fecha_fin }}</td>
                        <td>{{ number_format($poa->valor, 2) }}</td>
                        <td>
                        <td style="text-align: center;">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                       <!-- <a href="{{url('poas',$poa->id)}}" type="button" class="btn btn-secondary"><i class="bi bi-eye"></i></a>-->
                                        
                                        <a href="{{route('solicituds.edit',$poa->id)}}" type="button" class="btn btn-success"><i class="bi bi-file" title="Solicitar Certificado POA"></i></a>                                     
                                       <!-- <form action="{{route('solicituds.destroy' ,$poa->id)}}" onclick="preguntar<?=$id;?>(event)" method="post" id="miFormulario<?=$id;?>">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="border-radius: 0px 5px 5px 0px">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form> -->
                                 </div>
                                </td>

   

                            <script>
                                function preguntar<?=$id;?>(event) {
                                event.preventDefault();
                                Swal.fire({
                                    title: 'Eliminar registro',
                                    text: '¿Desea eliminar este registro?',
                                    icon: 'question',
                                    showDenyButton: true,
                                    confirmButtonText: 'Eliminar',
                                    confirmButtonColor: '#a5161d',
                                    denyButtonColor: '#270a0a',
                                    denyButtonText: 'Cancelar',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        var form = $('#miFormulario<?=$id;?>');
                                        form.submit();
                                    }
                                });
                                }
                            </script>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
