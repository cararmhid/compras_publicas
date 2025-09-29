@extends('layouts.admin')

@section('content')

    <div class="content" style="margin-left: 20px;">
        <h1>Flujo del Requerimiento</h1>

        @if($message = Session::get('mensaje'))
            <script>
                Swal.fire({
                    title: "Buen Trabajo",
                    text: "{{ $message }}",
                    icon: "success"
                });
            </script>
        @endif

        @if($message = Session::get('mensaje1'))
            <script>
                Swal.fire({
                    title: "Acceso Denegado",
                    text: "{{ $message }}",
                    icon: "error"
                });
            </script>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Flujo</b></h3>
                        <div class="card-tools">
                            @if (session('menu13') == 1)
                            <a href="{{ url('/designar') }}" class="btn btn-primary">
                                <i class="bi bi-file-plus"></i> Designar Administrador
                            </a>
                            @endif
                            @if (session('menu12') == 1)
                            <a href="{{ url('/asignar') }}" class="btn btn-primary">
                                <i class="bi bi-file-plus"></i> Asignación de Procesos
                            </a>
                            @endif
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <table id="flujos" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nro Necss</th>
                                    <th>Sub.</th>
                                    <th>Orden</th>
                                    <th>Responsable</th>
                                    <th>Fecha Ini</th>
                                    <th>Fecha Fin</th>
                                    <th>Tiempo</th>
                                    <th>Estado</th>
                                    <th>id_user</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($flujos as $flujo)
                                    <tr style="color: {{ $flujo->estado == '4' ? 'red' : 'black' }};">
                                        <td></td>
                                        <td>{{ $flujo->nro_nec }}</td>
                                        <td>{{ $flujo->nro_nec1 }}</td>
                                        <td>{{ $flujo->orden }}</td>
                                        <td>{{ $flujo->dpto }}</td>
                                        <td>{{ $flujo->fecha_ini }}</td>
                                        <td>{{ $flujo->fecha_fin }}</td>
                                        <td>{{ $flujo->tiempo }}</td>
                                        <td>{{ $flujo->estado }}</td>
                                        <td>{{ $flujo->id_user }}</td>
                                        <td style="text-align: center;">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                         
                                                <a href="#" data-toggle="modal" title="Visualiza la Actividad y Observaciones" data-target="#detalleModal{{ $flujo->id }}" type="button" class="btn btn-secondary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="detalleModal{{ $flujo->id }}" tabindex="-1" role="dialog" aria-labelledby="detalleModalLabel{{ $flujo->id }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="detalleModalLabel{{ $flujo->id }}">Detalles del Flujo</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label for="">Descripción de lo que debe hacer</label>
                                                                <p>{{ $flujo->descripcion }}</p>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label for="">El trámite fue devuelto por...</label>
                                                                <p>{{ $flujo->observaciones }}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                          
                                            
                                            @switch($flujo->estado)
                                                @case(3)
                                         
                                                    <a href="{{ route('flujos.edit', $flujo->id) }}" title="Actividad Realizada" type="button" style="background-color: rgb(241, 231, 98); color: rgb(6, 1, 1);" class="btn btn-secondary">
                                                        <i class="bi bi-emoji-sunglasses"></i>
                                                    </a>
                                                    @break
                                            
                                                @case(2)
                                                    @if ($flujo->fecha_fin > Carbon\Carbon::now()->toDateTimeString())
                                                        <a href="{{ route('flujos.edit', $flujo->id) }}" title="Cumplir con la Actividad" type="button" class="btn btn-success">
                                                            <i class="bi bi-tools"></i>
                                                        </a> 
                                                    @else
                                                        <a href="{{ route('flujos.edit', $flujo->id) }}" title="Actividad en Mora" type="button" style="background-color: rgb(248, 75, 49); color: rgb(0, 0, 0);" class="btn btn-secondary">
                                                            <i class="bi bi-emoji-tear"></i>
                                                        </a>
                                                    @endif
                                                    @break
                                            
                                                @default
                                                    <!-- Puedes agregar un caso por defecto si es necesario -->
                                            @endswitch
                                              
                                                <!-- <form action="{{ route('necesidads.destroy', $flujo->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('¿Está seguro de eliminar este registro?')" class="btn btn-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form> -->
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <script>
                            $(function () {
                                $("#flujos").DataTable({
                                    "pageLength": 10,
                                    "language": {
                                        "emptyTable": "No hay información",
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ flujos",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 flujos",
                                        "infoFiltered": "(Filtrado de _MAX_ total flujos)",
                                        "lengthMenu": "Mostrar _MENU_ flujos",
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
                                    buttons: [{
                                        extend: 'collection',
                                        text: 'Reportes',
                                        orientation: 'landscape',
                                        buttons: [{
                                            text: 'Copiar',
                                            extend: 'copy',
                                        }, {
                                            extend: 'pdf'
                                        }, {
                                            extend: 'csv'
                                        }, {
                                            extend: 'excel'
                                        }, {
                                            text: 'Imprimir',
                                            extend: 'print'
                                        }]
                                    }, {
                                        extend: 'colvis',
                                        text: 'Visor de columnas',
                                    }],
                                    order: [[0, "asc"]],
                                    columnDefs: [{
                                        targets: 0,
                                        visible: false,
                                        searchable: false
                                    }],
                                    initComplete: function () {
                                        this.api().buttons().container().appendTo('#flujos_wrapper .col-md-6:eq(0)');
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