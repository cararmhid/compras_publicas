@extends('layouts.admin')

@section('content')

<div class="content" style="margin-left: 20px">
    <h1>Listado POA</h1>

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
                    <h3 class="card-title"><b>Poa</b></h3>
                    <div class="card-tools">
                        <a href="{{url('poas/create')}}" class="btn btn-primary">
                            <i class="bi bi-file-plus"></i> Agregar nuevo POA
                        </a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>   
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <table id="poas" class="table table-bordered table-striped table-sm">
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
                        @foreach($poas as $poa)
                            <tr>
                                <td>{{ $poa->meta }}</td>
                                <td>{{ $poa->direccion->direcc }}</td>
                                <td>{{ $poa->depar->dpto }}</td>
                                <td>{{ $poa->fecha_ini }}</td>
                                <td>{{ $poa->fecha_fin }}</td>
                                <td>{{ number_format($poa->valor, 2) }}</td>
                                <td style="text-align: center;">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{url('poas',$poa->id)}}" type="button" class="btn btn-secondary"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('poas.edit',$poa->id)}}" type="button" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                        <form action="{{route('poas.destroy',$poa->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
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
                            $("#poas").DataTable({
                                "pageLength": 10,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ poas",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 poas",
                                    "infoFiltered": "(Filtrado de _MAX_ total poas)",
                                    "lengthMenu": "Mostrar _MENU_ poas",
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
                                columnDefs: [
                                    {
                                        targets: 0,
                                        visible: true, // Asegúrate de que la columna "Meta" esté visible
                                        searchable: true
                                    }
                                ],
                                initComplete: function () {
                                    this.api().buttons().container().appendTo('#poas_wrapper .col-md-6:eq(0)');
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