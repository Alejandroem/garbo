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
                    <div class="tab-pane fade
                                @if($active = session('list'))
                                active
                                @endif
                                " id="peticiones">
                        <br>
                        @include('peticiones.list')
                    </div>
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
