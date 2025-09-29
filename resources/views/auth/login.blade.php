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

<div class="login-box">
  <div class="login-logo">
    <a href="{{url('/')}}"><b>SISTEMA DE COMPRAS PÚBLICAS</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

    @if (session('status')) 
      <div class="alert alert-success"> 
        {{ session('status') }} 
      </div> 
    @endif
    
      <p class="login-box-msg">Ingrese sus credenciales</p>
    
      <div class="row">
        <div class="col-md-12">
          <form method="POST" action="{{ route('login') }}">
          @csrf
            <div class="row mb-12">
                <label for="email" >{{ __('Dirección de correo electronico') }}</label>
                <div class="col-md-12">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
            </div>
            <br>
            <div class="row mb-12">
                <label for="password">{{ __('Contraseña') }}</label>

                <div class="col-md-12">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
            </div>
            <hr>
            <div class="row mb-0">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Ingresar') }}
                    </button>
                </div>
            </div>
          </form>
          <br/>
          <br/> 

          <div class="row"> 
            <div class="col-12 text-right"> 
              <p class="mb-1"> 
                <a href="{{ route('password.request') }}">¡Olvidé mi contraseña!</a> 
              </p> 
            </div> 
          </div>

        </div>
      </div>

    </div>
    <!-- /.login-card-body -->
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
