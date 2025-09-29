@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Nuevo usuario</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/usuarios')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Nombre del usuario</label>
                                    <input type="text" id="name" value="{{old('name')}}" name="name" class="form-control" required>
                                    @error('name')
                                    <small style="color: red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" value="{{old('email')}}" name="email" class="form-control" required>
                                    @error('email')
                                    <small style="color: red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" required>
                                    @error('password')
                                    <small style="color: red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password_confirmation">Repetir Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cargo">Cargo</label>
                                    <input type="text" id="cargo" name="cargo" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="id_direcc">Dirección</label>
                                    <select class="form-control" id="id_direcc" name="id_direcc" required>
                                        @foreach($direccions as $direccion)
                                            <option value="{{ $direccion->id }}">{{ $direccion->direcc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="id_dpto">Departamento</label>
                                    <select class="form-control" id="id_dpto" name="id_dpto" required>
                                        @foreach($depars as $depar)
                                            <option value="{{ $depar->id }}">{{ $depar->dpto }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h3 class="card-title"></h3>
                        <h4>Seleccione el Acceso al Menu</h4>
                        <br>
                        <div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="menu1">Usuarios:</label>
                                    <input type="hidden" name="menu1" value="0">
                                    <input type="checkbox" id="menu1" name="menu1" value="1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="menu2">Formatos:</label>
                                    <input type="hidden" name="menu2" value="0">
                                    <input type="checkbox" id="menu2" name="menu2" value="1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="menu3">Solicitar Certificación POA:</label>
                                    <input type="hidden" name="menu3" value="0">
                                    <input type="checkbox" id="menu3" name="menu3" value="1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="menu4">Seguimiento a los Procesos:</label>
                                    <input type="hidden" name="menu4" value="0">
                                    <input type="checkbox" id="menu4" name="menu4" value="1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="menu5">Reformas al PAC:</label>
                                    <input type="hidden" name="menu5" value="0">
                                    <input type="checkbox" id="menu5" name="menu5" value="1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="menu6">Tipos de Procedimiento:</label>
                                    <input type="hidden" name="menu6" value="0">
                                    <input type="checkbox" id="menu6" name="menu6" value="1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="menu7">Ingreso del POA:</label>
                                    <input type="hidden" name="menu7" value="0">
                                    <input type="checkbox" id="menu7" name="menu7" value="1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="menu8">Gráficos:</label>
                                    <input type="hidden" name="menu8" value="0">
                                    <input type="checkbox" id="menu8" name="menu8" value="1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="menu9">Tablas Paramétricas:</label>
                                    <input type="hidden" name="menu9" value="0">
                                    <input type="checkbox" id="menu9" name="menu9" value="1">
                                </div>
                            </div>
                       
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="menu10">Administra Formatos:</label>
                                    <input type="hidden" name="menu10" value="0">
                                    <input type="checkbox" id="menu10" name="menu10" value="1">
                                </div>
                            </div>    
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="menu11">Administra Requerimientos:</label>
                                        <input type="hidden" name="menu11" value="0">
                                        <input type="checkbox" id="menu11" name="menu11" value="1">
                                    </div>
                                </div>    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="menu12">Asigna Infimas:</label>
                                            <input type="hidden" name="menu12" value="0">
                                            <input type="checkbox" id="menu12" name="menu12" value="1">
                                        </div>
                                    </div>    
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="menu13">Designa Administrador Proceso:</label>
                                                <input type="hidden" name="menu13" value="0">
                                                <input type="checkbox" id="menu13" name="menu13" value="1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{url('admin/usuarios')}}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary"><i class="bi bi-floppy2"></i> Guardar registro</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
