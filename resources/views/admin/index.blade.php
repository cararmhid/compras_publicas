@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Pantalla Principal</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-3 col-6">

            <script>
            // Redirigir automáticamente a la página del gráfico
                window.location.href = "{{ url('/grafico') }}";
            </script>

            <div class="small-box bg-warning">
                <div class="inner">
                    @php $contador_de_usuarios=0; @endphp
                    @foreach($usuarios as $usuario)
                        @php $contador_de_usuarios++; @endphp
                    @endforeach
                    <h3>{{$contador_de_usuarios}}</h3>
                    <p>Usuarios registrados</p>                </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
