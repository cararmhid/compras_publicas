@extends('layouts.admin')


@section('content')
    <div class="content" style="margin-left: 10px">
        <h1>Datos del formato</h1><br>


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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Descripción</label>
                                                <input type="text" name="descripcion" value="{{$formato->descripcion}}" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Url</label> 
                                                <input type="text" name="url" value="{{$formato->url}}" class="form-control" disabled>
                                            </div>
                                        </div>

                                       </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <!-- <a href="{{url('formatos')}}" class="btn btn-secondary">Regresar</a> -->

                                    <button id="back-button" class="btn btn-secondary mb-3">Regresar</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script> 
        $(document).ready(function() { 
            $('#back-button').click(function() { 
                var currentPage = localStorage.getItem('current_page'); 
                if (currentPage !== null) { 
                    window.history.back(); 
                } else { 
                    window.location.href = '/formatos'; // Reemplaza con la URL deseada 
                } 
            }); 
        }); 
    </script>
@endsection

