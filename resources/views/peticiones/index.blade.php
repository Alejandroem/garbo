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
                    <li class="active"><a href="#nueva-peticion" data-toggle="tab">Nueva peticion</a>
                    </li>
                    <li><a href="#peticiones" data-toggle="tab">Todas mis peticiones</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    @include('peticiones.create')
                    @include('peticiones.list')
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>




@endsection