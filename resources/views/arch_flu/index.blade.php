@extends('layouts.admin')

@section('content')

    <div class="content" style="margin-left: 20px">
        <h1>Listado de documentos por Requerimiento</h1>

        @if (session('error'))
            <div class="alert alert-danger" id="error-message">
                {{ session('error') }}
            </div>
        @endif

        <script>
            // Esperar 5 segundos antes de eliminar el mensaje
            setTimeout(function() {
                var element = document.getElementById("error-message");
                if (element) {
                    element.style.transition = "opacity 0.5s ease-out";
                    element.style.opacity = 0;
                    setTimeout(function() {
                        element.remove();
                    }, 500); // Esperar a que la transición de opacidad termine antes de eliminar el elemento
                }
            }, 5000); // 5000 milisegundos = 5 segundos
        </script>

        <style>
            .alert {
                transition: opacity 0.5s ease-out;
            }
        </style>

        @if($message = Session::get('mensaje'))
            <script>
                Swal.fire({
                    title: "Buen trabajo",
                    text: "{{$message}}",
                    icon: "success"
                }).then((result) => {
                    if (result.isConfirmed) {
                        localStorage.setItem('sweetalertShown', 'true');
                        history.replaceState(null, '', location.href);
                    }
                });
            </script>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                       
                        <div class="card-tools">
                            <a href="{{url('arch_flus/create')}}" class="btn btn-primary">
                                <i class="bi bi-file-plus"></i> Agregar nuevo Documento
                            </a>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>

                        <div class="card-tools">
                            <a href="{{ url('descargar-todos1') }}" class="btn btn-primary">
                                Descargar Todo el Expediente USUARIOS
                            </a>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                           
                            </button>
                        </div>

                        <div class="card-tools">
                            <a href="{{ url('descargar-todos') }}" class="btn btn-primary">
                                Descargar Todo el Expediente SERCOP
                            </a>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                           
                            </button>
                        </div>

                        <div class="card-tools">
                            <a href="{{ url('/necesidads') }}" class="btn btn-secondary">
                                Cancelar
                            </a>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            
                            </button>
                        </div>

                    </div>
                    <div class="card-body" style="display: block;">

                        <table id="arch_flus" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th></th>
                                    
                                    <th>Nro Nec</th>
                                    <th>Sub</th>
                                    <th>Documento</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $contador = 0; @endphp

                            @foreach($arch_flus as $arch_flu)
                                @php
                                    $id = $arch_flu->id;
                                @endphp
                                <tr>
                                    <td></td>
                                    
                                    <td>{{$arch_flu->nro_nec}}</td>
                                    <td>{{$arch_flu->nro_nec1}}</td>
                                    <td>{{$arch_flu->documento}}</td>
                                    <td style="text-align: center;">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('arch_flus.download', $arch_flu->id) }}" title="Descarga de Archivos" class="btn btn-warning"><i class="bi bi-download"></i></a>
                                            <form action="{{route('arch_flus.destroy',$arch_flu->id)}}" title="Eliminación de Archivos" onclick="preguntar{{$id}}(event)" method="post" id="miFormulario{{$id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" style="border-radius: 0px 5px 5px 0px">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                            <script>
                                                function preguntar{{$id}}(event) {
                                                    event.preventDefault();
                                                    Swal.fire({
                                                        title: 'Eliminar registro',
                                                        text: '¿Desea eliminar este registro? Le recordamos que se guarda el usuario y la hora de quien eliminó el REGISTRO',
                                                        icon: 'question',
                                                        showDenyButton: true,
                                                        confirmButtonText: 'Eliminar',
                                                        confirmButtonColor: '#a5161d',
                                                        denyButtonColor: '#270a0a',
                                                        denyButtonText: 'Cancelar',
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            var form = $('#miFormulario{{$id}}');
                                                            form.submit();
                                                        }
                                                    });
                                                }
                                            </script>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <script>
                            $(function () {
                                var table = $("#arch_flus").DataTable({
                                    "pageLength": 10,
                                    "language": {
                                        "emptyTable": "No hay información",
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ arch_flus",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 arch_flus",
                                        "infoFiltered": "(Filtrado de _MAX_ total arch_flus)",
                                        "lengthMenu": "Mostrar _MENU_ arch_flus",
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
                                        }]
                                    },
                                    {
                                        extend: 'colvis',
                                        text: 'Visor de columnas',
                                    }],
                                    order: [[ 0, "asc" ]],
                                    columnDefs: [
                                        {
                                            targets: 0,
                                            visible: false,
                                            searchable: false
                                        }
                                    ],
                                    initComplete: function () {
                                        this.api().buttons().container().appendTo('#arch_flus_wrapper .col-md-6:eq(0)');
                                    }
                                });

                                // Guardar la página actual en localStorage
                                table.on('page.dt', function() {
                                    var info = table.page.info();
                                    localStorage.setItem('current_page', info.page);
                                });

                                // Restaurar la página actual desde localStorage
                                var currentPage = localStorage.getItem('current_page');
                                if (currentPage !== null) {
                                    table.page(parseInt(currentPage)).draw('page');
                                }
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection