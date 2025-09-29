<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Compras Públicas | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">

    @if ($errors->any()) 
        <div class="alert alert-danger"> 
            <ul> 
                @foreach ($errors->all() as $error) 
                    <li>{{ $error }}</li> 
                @endforeach 
            </ul> 
        </div> 
    @endif 
    
    @if (session('status')) 
        <div class="alert alert-success"> 
            {{ session('status') }} 
        </div> 
    @endif
    <div class="login-box">
        <div class="login-logo">
            <h3><b>Cambiar Contraseña</b></h3>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('password.update') }}" method="post">
                @csrf
                    <div class="row mb-12">
                        <div class="card" style="width: 100%; padding: 20px; border: 1px solid #ddd; border-radius: 5px;"> 
                            <div class="card-body">
                                <div class="row mb-12">
                                    <label>Ingresa tu contraseña actual</label>
                                    <div class="input-group" style="display: flex; align-items: center;">
                                        <input type="password" name="current_password" class="form-control" placeholder="Contraseña actual" required style="flex: 1;">
                                        <div class="input-group-text" style="display: flex; align-items: center; margin-left: 10px;">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>      
                                </div>
                                </br>

                                <div class="row mb-12">
                                    <label>Ingresa tu nueva contraseña</label>
                                    <div class="input-group" style="display: flex; align-items: center;">
                                        <input type="password" name="new_password" class="form-control" placeholder="Nueva Contraseña" required style="flex: 1;">
                                        <div class="input-group-text" style="display: flex; align-items: center; margin-left: 10px;">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>      
                                </div>
                                </br>

                                <div class="row mb-12">
                                    <label>Repite tu contraseña</label>
                                    <div class="input-group" style="display: flex; align-items: center;">
                                        <input type="password" name="new_password_confirmation" class="form-control" placeholder="Confirmar nueva contraseña" required style="flex: 1;">
                                        <div class="input-group-text" style="display: flex; align-items: center; margin-left: 10px;">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>      
                                </div>
                                </br>

                                <!--  </div>
                                </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-block">Cambiar contraseña</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
</body>
</html>

