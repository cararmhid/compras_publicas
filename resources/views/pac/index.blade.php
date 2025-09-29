@extends('layouts.admin')

@section('content')

<div class="content" style="margin-left: 20px">
    <h1>Listado PAC</h1>

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
                    <h3 class="card-title"><b>PAC</b></h3>
                    <div class="card-tools">
                        <a href="{{url('pacs/create')}}" class="btn btn-primary">
                            <i class="bi bi-file-plus"></i> Agregar nuevo PAC
                        </a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>   
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <table id="pacs" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Partida</th>
                                <th>Cpc</th>
                                <th>Tipo de Compra</th>
                                <th>Descripción</th>
                                <th>Pc</th>
                                <th>Sc</th>
                                <th>Tc</th>
                                <th>Precio</th>
                                <th>Departamento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($pacs as $pac)
                            <tr>
                                <td>{{ $pac->partida }}</td>
                                <td>{{ $pac->cpc }}</td>
                                <td>{{ $pac->tip_comp }}</td>
                                <td>{{ $pac->descripcion }}</td>
                                <td>{{ $pac->pc }}</td>
                                <td>{{ $pac->sc }}</td>
                                <td>{{ $pac->tc }}</td>
                                <td>{{ number_format(floatval($pac->precio), 2) }}</td>
                                <td>{{ $pac->depar->dpto }}</td>
                                <td style="text-align: center;">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{url('pacs', $pac->id)}}" type="button" class="btn btn-secondary"><i class="bi bi-eye"></i></a>
                                        @if ($pac->borrado<>1) 
                                            <a href="{{route('pacs.edit', $pac->id)}}" type="button" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                        @else
                                            <a href="#" type="button" class="btn btn-dark">
                                            <i class="bi bi-x-circle" title="Requerimiento Anulado"></i> 
                                            </a>  
                                        @endif  
                                        
                                       
                                        <form action="{{route('pacs.destroy', $pac->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('¿Está seguro de ANULAR este registro?')" class="btn btn-danger custom-btn">
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
                            $("#pacs").DataTable({
                                "pageLength": 10,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ PACs",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 PACs",
                                    "infoFiltered": "(Filtrado de _MAX_ total PACs)",
                                    "lengthMenu": "Mostrar _MENU_ PACs",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "Buscador:",
                                    "zeroRecords": "Sin resultados encontrados",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Último",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    }
                                },
                                "responsive": true,
                                "lengthChange": true,
                                "autoWidth": false,
                                "buttons": [
                                    {
                                        extend: 'collection',
                                        text: 'Reportes',
                                        buttons: [
                                            { extend: 'copy', text: 'Copiar' },
                                            { extend: 'pdf', text: 'PDF' },
                                            { extend: 'csv', text: 'CSV' },
                                            { extend: 'excel', text: 'Excel' },
                                            { extend: 'print', text: 'Imprimir' }
                                        ]
                                    },
                                    {
                                        extend: 'colvis',
                                        text: 'Visor de columnas'
                                    }
                                ],
                                order: [[0, "asc"]],
                                initComplete: function () {
                                    this.api().buttons().container().appendTo('#pacs_wrapper .col-md-6:eq(0)');
                                }
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection