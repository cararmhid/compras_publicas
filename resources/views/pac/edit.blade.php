@extends('layouts.admin')

@section('content')

<div class="content" style="margin-left: 10px">
    <h1>Actualización del PAC</h1><br>


        @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            <li>{{$error}}</li>
        </div>
        @endforeach


    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title"><b>Llene los datos</b></h3>
                </div>
                <div class="card-body" style="display: block;">
                    <form action="{{ route('pacs.update', $pac->id) }}"  method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-12   ">
                                <div class="row">
                                    <div class="col-md-1 form-group">
                                        <label for="año">Año</label>
                                        <input type="text" class="form-control" id="año" name="año" value="{{ $pac->año }}" required>
                                    </div>

                                    <div class="col-md-2" class="form-group" >
                                        <label for="">Partida</label>
                                        <input type="text" class="form-control" id="partida" name="partida" value="{{$pac->partida}}" required>
                                    </div>

                                    <div class="col-md-2" class="form-group" >
                                        <label for="">Cpc</label>
                                        <input type="text" class="form-control" id="cpc" name="cpc" value="{{$pac->cpc}}" required>
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="id_proceso">Tipo de Compra</label>
                                        <select class="form-control" id="tip_comp" name="tip_comp" required>
                                            <option value="" disabled selected>Seleccione el Tipo de Compra</option>
                                            @foreach($options as $option)
                                                <option value="{{ $option }}" {{ $option == $pac->tip_comp ? 'selected' : '' }}>
                                                    {{ $option }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">Descripción</label><b>*</b>
                                            <textarea id="descripcion" class="form-control" rows="3" style="width: 100%;" name="descripcion"> {{$pac->descripcion}} </textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-1" class="form-group" >
                                        <label for="">Cantidad</label>
                                        <input type="text" class="form-control" id="cantidad" name="cantidad" value="{{$pac->cantidad}}" required>
                                    </div>

                                    <div class="col-md-1" class="form-group" >
                                        <label for="">Unidad</label>
                                        <input type="text" class="form-control" id="unidad" name="unidad" value="{{$pac->unidad}}" required>
                                    </div>

                                    <div class="col-md-2" class="form-group">
                                        <label for="">Precio</label>
                                        <input type="decimal" class="form-control" id="precio" name="precio" value="{{$pac->precio}}" required>
                                    </div>
  
                                    <div class="col-md-1" class="form-group" >
                                        <label for="">PC (x)</label>
                                        <input type="text" class="form-control" id="pc" name="pc" value="{{$pac->pc}}" required  >
                                    </div>

                                    <div class="col-md-1" class="form-group" >
                                        <label for="">SC (x)</label>
                                        <input type="text" class="form-control" id="sc" name="sc" value="{{$pac->sc}}" required >
                                    </div>

                                    <div class="col-md-1" class="form-group" >
                                        <label for="">TC (x)</label>
                                        <input type="text" class="form-control" id="tc" name="tc" value="{{$pac->tc}}" required >
                                    </div>

                                    <div class="col-md-2" class="form-group" >
                                        <label for="">Normalizado S/N</label>
                                        <input type="text" class="form-control" id="normalizado" name="normalizado" value="{{$pac->normalizado}}" required>
                                    </div>

                                    <div class="col-md-2" class="form-group" >
                                        <label for="">Catálogo S/N</label>
                                        <input type="text" class="form-control" id="catalogo" name="catalogo" value="{{$pac->catalogo}}" required>
                                    </div>

                                    <div class="col-md-5 form-group">
                                        <label for="id_proceso">Tipo de Proceso</label>
                                        <select class="form-control" id="id_proceso" name="id_proceso" required>
                                            <option value="" disabled selected>Seleccione el Tipo de Proceso</option>
                                             @foreach($procesos as $proceso)
                                                <option value="{{ $proceso->id }}" {{ $proceso->id == $pac->id_proceso ? 'selected' : '' }}>
                                                    {{ $proceso->proceso }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-1" class="form-group" >
                                        <label for="">Fondo S/N</label>
                                        <input type="text" class="form-control" id="fondo" name="fondo" value="{{$pac->fondo}}" required>
                                    </div>

                                    <div class="col-md-2" class="form-group" >
                                        <label for="id_proceso">Régimen</label>
                                        <select class="form-control" id="regimen" name="regimen" value="{{$pac->regimen}}" required>
                                            <option value="" disabled selected>Seleccione el Régimen</option>
                                             @foreach($regims as $regim)
                                                <option value="{{ $regim }}" {{ $regim == $pac->regimen ? 'selected' : '' }}>
                                                    {{ $regim }} 
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="id_proceso">Tipo de Presupuesto</label>
                                        <select class="form-control" id="tipo_presupuesto" name="tipo_presupuesto" required>
                                            <option value="" disabled selected>Seleccione el Tipo de Presupuesto</option>
                                            @foreach($presups as $presup)
                                                <option value="{{ $presup }}" {{ $presup == $pac->tipo_presupuesto ? 'selected' : '' }}>
                                                    {{ $presup }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="id_dpto">Departamento</label>
                                        <select class="form-control" id="id_dpto" name="id_dpto" required>
                                        <option value="" disabled selected>Seleccione el Departamento</option>
                                            @foreach($depars as $depar)
                                            <option value="{{ $depar->id }}" {{ $depar->id == $pac->id_dpto ? 'selected' : '' }}>
                                                    {{ $depar->dpto }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2" class="form-group" >
                                        <label for="id_proceso">Motivo de la Reforma</label>
                                        <select class="form-control" id="reforma" name="reforma" value="{{$pac->reforma}}" required>
                                            <option value="" disabled selected>Seleccione el Motivo de la Reforma</option>
                                            @foreach($reforms as $reform)
                                                <option value="{{ $reform }}" {{ $reform == $pac->reforma ? 'selected' : '' }}>
                                                    {{ $reform }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2" class="form-group" >
                                        <label for="">Nro. Reforma</label>
                                        <input type="text" class="form-control" id="nro_reforma" name="nro_reforma" value="{{$pac->nro_reforma}}" required>
                                    </div>
                                </div>
                                <br>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


