@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 10px">
    <h1>Formulario de documentación para pagos</h1><br>

    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            <li>{{ $error }}</li>
        </div>
    @endforeach

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title"><b>Llene los datos</b></h3>
                </div>
                <div class="card-body">
                    <!-- FORMULARIO PRINCIPAL -->
                    <form action="{{ url('/flujos', $flujos->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            @if(session('nro_nec1') < 1)
                                <label for="pago_tipo">Tipo de Pago</label>
                                <select id="pago_tipo" name="pago_tipo" class="form-control" onchange="toggleButton()">
                                    <option value="unico">Un solo pago</option>
                                    <option value="varios">Varios pagos</option>
                                </select>
                            @endif
                        </div>

                        <div class="form-group" id="boton_div" style="display: none;">
                            <button type="submit" class="btn btn-secondary" name="boton1" value="12">Guardar</button>
                        </div>

                        <div class="form-group">
                            <label for="observaciones">Observación</label>
                            <b> Digite en caso de regresar el trámite</b>
                            <textarea id="observaciones" rows="3" style="width: 100%;" name="observaciones">{{ $flujos->observaciones }}</textarea>
                        </div>

                        <hr>

                        <!-- BOTONES DE ACCIÓN -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary" name="boton1" value="0">Cancelar</button>
                            <button type="submit" class="btn btn-primary" name="boton1" value="13">Informe de Satisfacción</button>
                            <button type="submit" class="btn btn-primary" name="boton1" value="15">Memorando para pago</button>
                            <button type="submit" class="btn btn-success" name="boton1" value="1">Regresar Trámite</button>
                            <button type="submit" class="btn btn-success" name="boton1" value="2">Continuar Trámite</button>
                        </div>
                    </form>

                    <!-- FORMULARIO INDEPENDIENTE PARA ACTA -->
                    <button type="button" class="btn btn-primary" onclick="mostrarOpciones()">Actas Entrega Recepción</button>

                    <form method="POST" action="{{ route('flujo.downloadAER') }}">
                        @csrf
                        <div id="opcionesActa" style="display:none; margin-top:10px;">
                            <label for="tipoActa">Seleccione el tipo:</label>
                            <select class="form-control" name="tipoActa" id="tipoActa">
                                <option value="bienes">Bienes</option>
                                <option value="servicios">Servicios</option>
                                <option value="consultoria">Consultoría</option>
                                <option value="obras">Obras</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Generar Acta</button>
                        </div>
                    </form>

                    <!-- SCRIPTS -->
                    <script>
                        function toggleButton() {
                            var pagoTipo = document.getElementById('pago_tipo').value;
                            var botonDiv = document.getElementById('boton_div');
                            botonDiv.style.display = (pagoTipo === 'varios') ? 'block' : 'none';
                        }

                        function mostrarOpciones() {
                            document.getElementById("opcionesActa").style.display = "block";
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
