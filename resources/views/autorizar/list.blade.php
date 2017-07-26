@if(count($peticiones)>0)
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Peticiones
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="col-md-1">
                            <label>Fecha: </label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group date datetimepicker">
                                <input id="desde" name="desde"  type='text' class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group date datetimepicker ">
                                <input id="hasta" name="hasta"  type='text' class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br><br>
                    <div class="col-md-8">
                        <div class="col-md-2">
                            <label>Tipo: </label>
                        </div>
                        <div class="col-md-7">

                            <select id="tipos" name="tipos" class="form-control">
                                <option></option>
                                @foreach($tiposPeticiones as $tipo)
                                <option>{{$tipo->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Solo pendientes: </label>
                        <style>
                            .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
                            .toggle.ios .toggle-handle { border-radius: 20px; }
                        </style>
                        <input id="pendientes" type="checkbox" data-toggle="toggle" data-style="ios">
                    </div>

                </div>
                <br>
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTablesPeticiones">
                    <thead>
                        <tr>
                            <th>Numero</th>
                            <th>Fecha</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Usuario</th>
                            <th></th>
                        </tr>
                    </thead>
                    @foreach($peticiones as $peticion)
                    <tr id="tr-{{$peticion->id}}" data-id="{{$peticion->id}}">
                        <td> {{$peticion->id}}</td>
                        <td> {{Carbon\Carbon::parse($peticion->fechaCreacion)->format('d/m/Y')}}</td>
                        <td> {{$peticion->tipo->nombre}}</td>
                        <td> {{$peticion->strEstado()}}</td>
                        <td> {{$peticion->idUsuario}}</td>
                        <td data-id="actions">
                            @if($peticion->estado==0)
                            <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                            @elseif($peticion->estado==1)
                            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                            @endif

                        </td>
                    </tr>
                    @include('autorizar.modal')
                    @endforeach

                    <tbody>

                    </tbody>
                </table>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->


@else
<div class="alert alert-info">
    No se encontró ninguna peticion
</div>
@endif




