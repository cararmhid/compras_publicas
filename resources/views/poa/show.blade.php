@extends('layouts.admin')


@section('content')
    <div class="content" style="margin-left: 10px">
        <h1>Datos del Poa</h1><br>


            @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                <li>{{$error}}</li>
            </div>
            @endforeach


        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-secondary    ">
                    <div class="card-header">
                        <h3 class="card-title"><b>Datos registrados</b></h3>
                    </div>
                    <div class="card-body" style="...">
                            <div class="row">
                                <div class="col-md-12   ">
                                    <div class="row">

                                        <div class="form-group">
                                            <label for="meta">Meta</label>
                                            <input type="text" class="form-control" id="meta" name="meta" value="{{ $poa->meta }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="id_direcc">Dirección</label>
                                            <select class="form-control" id="id_direcc" name="id_direcc" required>
                                                @foreach($direccions as $direccion)
                                                    <option value="{{ $direccion->id }}" {{ $direccion->id == $poa->id_direcc ? 'selected' : '' }}>{{ $direccion->direcc }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="id_dpto">Departamento</label>
                                            <select class="form-control" id="id_dpto" name="id_dpto" required>
                                                @foreach($depars as $depar)
                                                    <option value="{{ $depar->id }}" {{ $depar->id == $poa->id_dpto ? 'selected' : '' }}>{{ $depar->dpto }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha_ini">Fecha Inicio</label>
                                            <input type="date" class="form-control" id="fecha_ini" name="fecha_ini" value="{{ $poa->fecha_ini }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha_fin">Fecha Fin</label>
                                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="{{ $poa->fecha_fin }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="valor">Valor</label>
                                            <input type="number" class="form-control" id="valor" name="valor" value="{{ $poa->valor }}" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </form>
                                </div>




                                       </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                     <a href="{{url('poas')}}" class="btn btn-secondary">Regresar</a>

                                   <!-- <button id="back-button" class="btn btn-secondary mb-3">Regresar</button>-->
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
@endsection

