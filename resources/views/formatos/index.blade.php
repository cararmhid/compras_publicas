@extends('layouts.admin')

@section('content')

    <div class="content" style="margin-left: 20px">
        <h1>Formatos para Inicio de Procesos</h1>

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
                            @if (session('menu10') == 1) 
                            <a href="{{url('formatos/create')}}" class="btn btn-primary">
                                <i class="bi bi-file-plus"></i> Agregar nuevo formato
                            </a>
                            @endif
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>   
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">

                        <table id="formatos" class="table table-bordered table-striped table-sm">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Descripción</th>
                              <th>Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($formatos as $formato)
                                <tr>
                                    <td></td>
                                    <td>{{$formato->descripcion}}</td>
                                    <td style="text-align: center;">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{url('formatos',$formato->id)}}" type="button" class="btn btn-secondary"><i class="bi bi-eye" title="Visualiza el registro"></i></a>
                                            @if (session('menu10') == 1) 
                                                <a href="{{route('formatos.edit',$formato->id)}}" type="button" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                            @endif
                                                <a href="{{ route('formatos.download', $formato->id) }}" class="btn btn-warning"><i class="bi bi-download" title="Descargar Archivo"></i></a>
                                            
                                            <form action="{{route('formatos.destroy',$formato->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                @if (session('menu10') == 1) 
                                                    <button type="submit" onclick="return confirm('¿Esta seguro de eliminar este registro?')" class="btn btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                @endif 
                                                  
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
                                // Obtener la página actual desde localStorage 
                                //var currentPage = localStorage.getItem('current_page') ? parseInt(localStorage.getItem('current_page')) : 0; 

                                $("#formatos").DataTable({
                                    //dom: 'Bfrtip',
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
                                            //orientation: 'landscape',
                                            //collectionLayout: 'fixed three-column'
                                        }
                                    ],
                                    order: [[ 0, "asc" ]],
                                    columnDefs: [ 
                                        { 
                                        targets: 0,
                                        visible: false,
                                        searchable: false
                                         } ], 
                                         //displayStart: currentPage * 10, 
                                         initComplete: function () { 
                                            this.api().buttons().container().appendTo('#formatos_wrapper .col-md-6:eq(0)'); }     
                                });
                               //table.on('page.dt', function() { var info = table.page.info(); localStorage.setItem('current_page', info.page); });
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

