@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 10px">
    <h1>Subir un nuevo Documento</h1><br>

    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            <li>{{$error}}</li>
        </div>
    @endforeach

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Llene los datos</b></h3>
                </div>
                <div class="card-body" style="display: block;">
                    <form action="{{route('arch_flus.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">

                                    <div class="col-md-6 form-group">
                                        <label for="id_dpto">Listado de documentos por tipo de Flujo</label>
                                        <select class="form-control" id="id_dpto" name="id_dpto" required onchange="updateInput()">
                                            <option value="" disabled selected>Seleccione el nombre del documento</option>
                                            @foreach($docuflujos as $documento)
                                                <option value="{{ $documento->documento }}">{{ $documento->documento }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="documento">Documento</label><b>*</b>
                                            <input type="text" id="documento" name="documento" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre_doc">Archivo</label> <b>*</b>
                                            <input type="file" name="nombre_doc" class="form-control" required>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <a href="{{url('/arch_flus')}}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Guardar registro</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function updateInput() {
        var select = document.getElementById('id_dpto');
        var input = document.getElementById('documento');
        input.value = select.options[select.selectedIndex].value;
    }
</script>
@endsection