@extends('layouts.admin')

@section('content')

    <div class="content" style="margin-left: 20px">
        <h1>Listado de formatos TDR</h1>

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
                        <h3 class="card-title"><b>Formatos TDR</b></h3>
                        <div class="card-tools">
                            
                            <a href="{{url('/formatos/create')}}" class="btn btn-primary">
                                <i class="bi bi-file-plus"></i> Agregar nuevo formato
                            </a>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button> 
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">

                        <table id="formatos" class="table table-bordered table-striped table-sm">
                            <thead>
                            <tr>
                                <th>Descripción</th>
                                <th>Url</th>
                                <th>Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($formatos as $formato)
                                <tr>
                                    <td>{{$formato->descripcion}}</td>
                                    <td>{{$formato->url}}</td>
                                    <td style="text-align: center;">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <!-- <a href="{{url('formatos',$formato->id)}}" type="button" class="btn btn-info"><i class="bi bi-eye"></i></a> -->
                                            <a href="{{route('formatos.edit',$formato->id)}}" type="button" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                            
                                            <form action="{{url('formatos',$formato->id)}}" method="post">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" onclick="return confirm('¿Esta seguro de eliminar este registro?')" class="btn btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <script>
                            $(function () {
                                $("#formatos").DataTable({
                                    "pageLength": 10,
                                    "language": {
                                        "emptyTable": "No hay información",
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Formatos",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 Formatos",
                                        "infoFiltered": "(Filtrado de _MAX_ total Formatos)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Mostrar _MENU_ Formatos",
                                        "loadingRecords": "Cargando...",
                                        "processing": "Procesando...",
                                        "search": "Buscador:",
                                        "zeroRecords": "Sin resultados encontrados",
                                        "paginate": {
                                            "first": "Primero",
                                            "last": "Ultimo",
                                            "next": "Siguiente",
                                            "previous": "Anterior"
                                        }
                                    },
                                    "responsive": true, "lengthChange": true, "autoWidth": false,
                                    buttons: [{
                                        extend: 'collection',
                                        text: 'Reportes',
                                        orientation: 'landscape',
                                        buttons: [{
                                            text: 'Copiar',
                                            extend: 'copy',
                                        }, {
                                            extend: 'pdf'
                                        },{
                                            extend: 'csv'
                                        },{
                                            extend: 'excel'
                                        },{
                                            text: 'Imprimir',
                                            extend: 'print'
                                        }
                                        ]
                                    },
                                        {
                                            extend: 'colvis',
                                            text: 'Visor de columnas',
                                            collectionLayout: 'fixed three-column'
                                        }
                                    ],
                                }).buttons().container().appendTo('#formatos_wrapper .col-md-6:eq(0)');
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

