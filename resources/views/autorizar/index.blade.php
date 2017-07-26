@extends('layouts.app')

@section('page-title','Entrada de inventario de bodega')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li><a href="#peticiones" data-toggle="tab">Peticiones de cambio</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    @include('autorizar.list')
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <div class="col-lg-12 text-right">
        <a class="btn btn-default" href="{{route('peticion.index',['usuario'=>$usuario,'empresa'=>$empresa])}}">Regresar</a>
    </div>

</div>




@endsection
