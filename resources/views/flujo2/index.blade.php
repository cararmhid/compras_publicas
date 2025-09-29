@extends('layouts.admin')

@section('content')

<div class="content" style="margin-left: 20px">
    <h1>Listado de Catálogo Electrónico</h1>

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
                    <h3 class="card-title"><b>Catálogo Electrónico</b></h3>
                    <div class="card-tools">
                        
                        <a href="{{url('flujo2s/create')}}" class="btn btn-primary">
                            <i class="bi bi-file-plus"></i> Agregar nuevo flujo
                        </a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>   
                    </div>
                </div>
                <div class="card-body" style="display: block;">

                    <table id="flujo2s" class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Orden</th>
                            <th>Dpto</th>
                            <th>Descripción</th>
                            <th>Id Usuario</th>
                            <th>Tiempo</th>
                            <th>Formulario</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($flujo2s as $flujo2)
                            <tr>
                                <td></td>
                                <td>{{$flujo2->orden}}</td>
                                <td>{{$flujo2->dpto}}</td>
                                <td>{{$flujo2->descripcion}}</td>
                                <td>{{$flujo2->id_user}}</td>
                                <td>{{$flujo2->tiempo}}</td>
                                <td>{{$flujo2->formulario}}</td>

                                <td style="text-align: center;">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{url('flujo2s',$flujo2->id)}}" type="button" class="btn btn-secondary"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('flujo2s.edit',$flujo2->id)}}" type="button" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                        
                                        <form action="{{route('flujo2s.destroy',$flujo2->id)}}" method="post">
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
                            // Obtener la página actual desde localStorage 
                            //var currentPage = localStorage.getItem('current_page') ? parseInt(localStorage.getItem('current_page')) : 0; 

                            $("#flujo2s").DataTable({
                                //dom: 'Bfrtip',
                                "pageLength": 10,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Flujo2s",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Flujo2s",
                                    "infoFiltered": "(Filtrado de _MAX_ total Flujo2s)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Flujo2s",
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
                                        this.api().buttons().container().appendTo('#flujo2s_wrapper .col-md-6:eq(0)'); }     
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

