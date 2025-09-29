<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Compras Públicas | Usuarios</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">

    <!-- icono de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- JQuery -->
    <script src="{{asset('/plugins/jquery/jquery.js')}}"></script>

    <!-- datetables-->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{url('/')}}" class="nav-link">Compras Públicas</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">




            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>

        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{url('/')}}" class="brand-link">
            <img src="{{asset('dist/img/compras_publicas.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">COMPRAS PÚBLICAS</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('dist/img/user_perfil.png')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{Auth::user()->name}}</a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->


                @if (session('menu1') == 1) 
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-people"></i></i>
                            <p>
                                Usuarios
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('/admin/usuarios')}}" class="nav-link active">
                                <i class="fas fa-user-friends"></i>
                                    <p>Listado de usuarios</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                
                @endif
                @if (session('menu2') == 1) 
                      <li class="nav-item">
                        <a href="{{url('/formatos')}}" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-file-earmark-ruled"></i></i>
                            <p>
                                Formatos TDR
                            </p>
                        </a>
                    </li>
                
                    @endif
                    @if (session('menu3') == 1) 
                    <li class="nav-item">
                        <a href="{{url('/solicituds')}}" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-file-earmark-text"></i></i>
                            <p>
                                Iniciar Proceso de Compra
                            </p>
                        </a>
                    </li>                
                    @endif

                    @if (session('menu4') == 1) 
                    <li class="nav-item">
                        <a href="{{url('/necesidads')}}" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-stack-overflow"></i></i>
                            <p>
                                Seguimiento a los Procesos
                            </p>
                        </a>
                    </li>                
                    @endif

                    @if (session('menu5') == 1) 
                    <li class="nav-item">
                        <a href="{{url('/pacs')}}" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-pencil-square"></i></i>
                            <p>
                                Reformas al PAC
                            </p>
                        </a>
                    </li>
                    @endif

                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-menu-app"></i></i>
                            <p>
                                Tipo de Procedimientos
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('/flujo1s')}}" class="nav-link active">
                                <i class="bi bi-menu-button-fill"></i>
                                    <p>Infima Cuantía</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/flujo2s')}}" class="nav-link active">
                                <i class="bi bi-menu-button-fill"></i>
                                     <p>Catálogo Electrónico</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/flujo3s')}}" class="nav-link active">
                                <i class="bi bi-menu-button-fill"></i>
                                      <p>Común</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/flujo4s')}}" class="nav-link active">
                                <i class="bi bi-menu-button-fill"></i>
                                      <p>Especial</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/flujo5s')}}" class="nav-link active">
                                <i class="bi bi-menu-button-fill"></i>
                                      <p>Verificación Producto Nacional</p>
                                </a>
                            </li>
                        </ul>
                    </li>
            
                    @if (session('menu7') == 1) 
                    <li class="nav-item">
                        <a href="{{url('/poas')}}" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-journal-plus"></i></i>
                            <p>
                                Ingreso del POA
                            </p>
                        </a>
                    </li>
                    @endif

                @if (session('menu8') == 1)
                <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-graph-up-arrow"></i></i>
                            <p>
                               Gráficos Estadísticos
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/grafico') }}" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-bar-chart-fill"></i></i>
                                   <p>Procesos por Cuatrimestre</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/grafico/index1') }}" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-bar-chart-fill"></i></i>
                                    <p>Tipo de Procesos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/grafico/index2') }}" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-bar-chart-fill"></i></i>
                                    <p>Procesos por Unidades</p>
                                </a>
                            </li>
                            <li class="nav-item">
                            <a href="{{ url('/grafico/index3') }}" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-bar-chart-fill"></i></i>
                                    <p>Tipo de Reformas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/grafico/index4') }}" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-bar-chart-fill"></i></i>
                                    <p>Ahorro por Direcciones</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (session('menu9') == 1)
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-table"></i></i>
                            <p>
                                Tablas Paraméticas
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('/docuflujos')}}" class="nav-link active">
                                <i class="bi bi-ticket-detailed-fill"></i>
                                     <p>Listado de Documentos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/direcciones')}}" class="nav-link active">
                                <i class="bi bi-ticket-detailed-fill"></i>
                                    <p>Direcciones</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/depars')}}" class="nav-link active">
                                <i class="bi bi-ticket-detailed-fill"></i>
                                    <p>Departamentos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/procesos')}}" class="nav-link active">
                                <i class="bi bi-ticket-detailed-fill"></i>
                                    <p>Tipo de Procesos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/enviar-whatsapp')}}" class="nav-link active">
                                <i class="bi bi-ticket-detailed-fill"></i>
                                    <p>Archivos de los Requerimientos</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item" >
                            <a class="nav-link" href="{{ route('logout') }}" style="background-color: #d82912"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas"><i class="bi bi-door-closed"></i></i>  Cerrar Sesión
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>

                    @endguest

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <br>

        @if( ($message = Session::get('mensaje')) && ($icono = Session::get('icono')) )
            <script>
                Swal.fire({
                    title: "Mensaje",
                    text: "{{$message}}",
                    icon: "{{$icono}}"
                });
            </script>
        @endif


        <div class="container">
        
            @yield('content')
            
        </div>

    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Accesorios EMAPA-I</h5>
            <p></p>
            <p>Sidebar content</p>

            <aside class="control-sidebar control-sidebar-dark">
                <nav> 
                    <ul> 
                        <li><h5><a href="{{url('https://okcalc.com/es/')}}" target="_blank" rel="noopener noreferrer" id="link-calculadora">Calculadora</a></h5> </li> 
                        <li><h5><a href="{{url( 'https://portal.compraspublicas.gob.ec/sercop/calculadora-de-presupuesto-referencial/')}}" target="_blank" rel="noopener noreferrer" id="link-calendario">Calculadora SERCOP</a></h5> </li> 
                        <li><h5><a href="{{url('https://calendar.google.com/calendar/u/0/r/month/2025/1/1?pli=1')}}" target="_blank" rel="noopener noreferrer" id="link-calculadora">Calendario</a></h5> </li> 
                        <li><h5><a href="{{ route('password.change') }}" onclick="return confirmChangePassword(event)">Cambiar Contraseña</a></h5> </li>
   
                        </ul> 
                </nav> 
                <div id="contenido"></div> 
            </aside> 
        

        </div>
    </aside>
    <script>
        function confirmChangePassword(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Cambiar Contraseña',
            text: 'Asegúrate de guardar o cerrar todas las pantallas abiertas antes de cambiar tu contraseña, ya que se cerrará tu sesión.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Cambiar',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirigir a la ruta de cambio de contraseña
                window.location.href = "{{ route('password.change') }}";
            }
        });
        }
    </script>




    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Inf. Técnica
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2025. Desarrollo: Ing. Carlos Hidrobo </strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<!-- <script> 
    $(document).ready(function() { 

        // Obtener la página actual desde localStorage 
        var currentPage = localStorage.getItem('current_page') ? parseInt(localStorage.getItem('current_page')) : 0; 
        
        // Manejar el evento de clic para el botón de regreso 
        $('#back-button').click(function() { window.history.back(); }); 
        
        // Guardar la página actual en localStorage 
        $(window).on('unload', function() { localStorage.setItem('current_page', currentPage); }); 
    }); 
</script> -->

</body>
</html>
