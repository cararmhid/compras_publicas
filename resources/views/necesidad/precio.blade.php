@extends('layouts.admin')

@section('content')

<div class="container mt-5">
    <h1 class="mb-4">Cambiar Precio PAC</h1>

    <form action="{{ route('ruta.updateprecio', $necesidad->id) }}" method="POST">
        @csrf
        @method('POST')
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nro_nec" class="form-label">Número de Necesidad</label>
                <input type="text" class="form-control" id="nro_nec" name="nro_nec" value="{{ $necesidad->nro_nec }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="requirente" class="form-label">Requirente</label>
                <input type="text" class="form-control" id="requirente" name="requirente" value="{{ $necesidad->responsable }}" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="tipo_proc" class="form-label">Tipo de Procedimiento</label>
                <input type="text" class="form-control" id="tipo_proc" name="tipo_proc" value="{{ $necesidad->tip_proc }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="precio_pac" class="form-label">Precio Referencial</label>
                <input type="text" class="form-control" id="precio_pac" name="precio_pac" value="{{ $necesidad->precio_pac }}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="precio_eje" class="form-label">Precio Adjudicación</label>
                <input type="text" class="form-control" id="precio_eje" name="precio_eje" value="{{ $necesidad->precio_eje }}">
            </div>
            <div class="col-md-6">
                <label for="ruc" class="form-label">RUC</label>
                <input type="text" class="form-control" id="ruc" name="ruc" value="{{ $necesidad->ruc }}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="proveedor" class="form-label">Proveedor</label>
                <input type="text" class="form-control" id="proveedor" name="proveedor" value="{{ $necesidad->proveedor }}">
            </div>
            <div class="col-md-6">
                <label for="nro_reforma" class="form-label">Nro. Reforma</label>
                <input type="text" class="form-control" id="nro_reforma" name="nro_reforma" value="{{ $necesidad->nro_reforma }}">
             <br>
            </div>
           
        <div class="d-flex align-items-center mb-3">
            <label for="status" class="form-label me-3 mb-0">¿Proceso Finalizado?&nbsp;&nbsp;</label>
            <select class="form-select form-select-sm w-auto" id="status" name="status">
                <option value="0" {{ $necesidad->status == 0 ? 'selected' : '' }}>No</option>
                <option value="2" {{ $necesidad->status == 2 ? 'selected' : '' }}>Sí</option>
            </select>
        </div>

        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('necesidads.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@endsection