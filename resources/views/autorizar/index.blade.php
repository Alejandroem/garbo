@extends('layouts.app')

@section('page-title')
<div class="col-lg-10">
    <h1 class="page-header">Entrada de inventario de bodega</h1>
</div>
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#peticiones" data-toggle="tab">Peticiones de cambio</a>
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
</div>
@endsection
