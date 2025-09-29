@extends('layouts.admin')

@section('content')

<div class="content" style="margin-left: 20px">
    <h1>Listado de Requerimientos</h1>

    @if($message = Session::get('mensaje'))
        <script>
            Swal.fire({
                title: " Buen trabajo",
                text: "{{$message}}",
                icon: "success"
            });
        </script>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Requerimientos</b></h3>
                    <div class="card-tools">

                    <a href="{{url('rep_mora')}}" class="btn btn-primary">
                            <i class="bi bi-file-plus"></i> Reporte de Procesos en Mora (PDF)
                        </a>
                        <a href="{{url('rep_mora_exe')}}" class="btn btn-primary">
                            <i class="bi bi-file-plus"></i> Reporte de Procesos en Mora (Excel)
                        </a>
                        
                        <a href="{{url('necesidads/create')}}" class="btn btn-primary">
                            <i class="bi bi-file-plus"></i> Mostrar mi Bandeja
                        </a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>   
                    </div>
                </div>
                <div class="card-body" style="display: block;">

                    <table id="necesidads" class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Nro Nec</th>
                            <th>Nro S.</th>
                            <th>Fecha Nec</th>
                            <th>Requirente</th>
                            <th>Objeto de Contrato</th>
                            <th>Tipo Procedimiento</th>
                            <th>Valor Pac</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($necesidads as $necesidad)
                            <tr>
                                <td></td>
                                <td>{{$necesidad->nro_nec}}</td>
                                <td>{{$necesidad->nro_nec1}}</td>
                                <td>{{$necesidad->fecha_nec}}</td>
                                <td>{{$necesidad->responsable}}</td>
                                <td>{{$necesidad->descripcion}}</td>
                                <td>{{$necesidad->tip_proc}}</td>
                                <td>{{ number_format(floatval($necesidad->precio_pac), 2) }}</td>

                                <td style="text-align: center;">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                      <!-- <a href="{{url('necesidads',$necesidad->id)}}" type="button" class="btn btn-secondary"><i class="bi bi-eye"></i></a> -->
                                        <a href="{{route('necesidads.show',$necesidad->id)}}" type="button" class="btn btn-info"><i class="bi bi-file-earmark" title="Subida y descarga de Archivos"></i></a>
                                    @if (session('menu11') == 1)
                                       <a href="{{route('necesidads.cambiarprecio',$necesidad->id)}}" type="button" class="btn btn-warning"><i class="bi bi-currency-dollar" title="Permite cambiar el precio"></i></a>
                                    @endif 
                                    @if ($necesidad->status<>1) 
                                        @if ($necesidad->status==2) 
                                            <a href="{{'#'}}" type="button" class="btn btn-dark"><i class="bi bi-sign-stop"  title="Flujo del Requerimiento"></i></a>
                                        @else
        
                                       <a href="{{route('necesidads.edit',$necesidad->id)}}" type="button" class="btn btn-success"><i class="bi bi-arrow-right" title="Flujo del Requerimiento"></i></a>
                                   @endif
                                       @else
             
                                        <a href="{{route('necesidads.edit',$necesidad->id)}}" type="button" class="btn btn-dark">
                                        <i class="bi bi-x-circle" title="Requerimiento Anulado"></i> 
                                        </a>  
                                        
                                     @endif  
                                   
                                     @if (session('menu11') == 1)  
                                       <form action="{{route('necesidads.destroy',$necesidad->id)}}" title="Anular Requerimiento" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('¿Está seguro de ANULAR este registro?')" class="btn btn-danger custom-btn">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                     @endif
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

                            $("#necesidads").DataTable({
                                //dom: 'Bfrtip',
                                "pageLength": 10,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ necesidads",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 necesidads",
                                    "infoFiltered": "(Filtrado de _MAX_ total necesidads)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ necesidads",
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
                                        this.api().buttons().container().appendTo('#necesidads_wrapper .col-md-6:eq(0)'); }     
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

