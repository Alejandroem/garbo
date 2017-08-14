<div class="tab-pane fade in 
            @if($active = session('create'))
            active
            @endif
            " id="nueva-peticion">
    <br>

    @if($flash = session('message'))
    <div id="flash-message" class="alert alert-success" role="alert">
        {{$flash}}
    </div>
    @endif

    <br>    


    <form id="search" role="form">
        {{csrf_field()}}
        <input id="empresa" name="empresa" type="text" value="{{$empresa}}" hidden>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="form-group">
                    <label>Bodega</label>
                    <select id="bodega" name="bodega" class="form-control">
                        @foreach($bodegas as $key=>$bodega)
                        <option value="{{$key}}">{{$bodega}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-3 ">
                <label>Número de entrada:</label>
                <div class="form-group input-group">
                    <input id="numero" name="numero" type="text" class="form-control" placeholder="Numero de entrada...">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default" type="button"><i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </form>

    <div id="error" hidden>
        <div class="row">
            <div class="col-md-6 col-md-offset-2 text-center">
                <button type="button" class="btn btn-warning btn-circle btn-xl"><i class="fa fa-times fa-6"></i>
                </button>
                <br>
                No encontrado
                <br>
                <br>
                <div class="col-md-8 col-md-offset-2">
                    El número de documento no existe en el sistema o su usuario no tiene acceso al mismo
                </div>
            </div>
        </div>
    </div>

    <div id="data" class="" hidden>
        <div class="text-right">
            <label>Creado por: </label>&nbsp;<span id="usuario"></span>
        </div>
        <div class="panel panel-default">

            <div class=" panel-body">
                <div class="row">
                    <div class="col-md-2">
                        <label>Numero de entrada: </label>
                    </div>
                    <div class="col-md-10">
                        <span id="numeroentrada"></span>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-2">
                        <label>Tipo de documento: </label> 
                    </div>
                    <div class="col-md-10">
                        <span id="tipoentrada"></span>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-2">
                        <label>Fecha de Documento: </label> 
                    </div>
                    <div class="col-md-10">
                        <span id="fechaentrada"></span>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-2">
                        <label>Descripcion: </label>  
                    </div>
                    <div class="col-md-10">
                        <span id="descripcion"></span>
                    </div>
                </div>
                <br>
                <div id="opciones" class="panel panel-default">
                    <a data-toggle="collapse" data-parent="#accordion" href="#opcionesmodificacion">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        Opciones de modificación
                    </a>

                    <div id="opcionesmodificacion" class="panel-collapse collapse">
                        <div class="panel-body">
                            <form id="createform" method="post" action="{{route('peticion.store')}}">
                                {{csrf_field()}}
                                <div class="row">
                                    <input type='text' id="codigo" name="codigo"  hidden>
                                    <input type='text' id="idUsuario" name="idUsuario" value="{{$usuario}}"  hidden>
                                    <input type='text' id="empresa" name="empresa"  value="{{$empresa}}" hidden>
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="form-group">
                                            <label>Nueva fecha de documento: </label>
                                            <div class='input-group date datePicker'>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                                <input name="nuevafecha" id="nuevafecha" type='text' class="form-control" placeholder="Fecha en formato dd/mm/yyyy"/>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-8 col-md-offset-2 text-right">
                                        <button type="submit" class="btn btn-primary"> Solicitar cambio</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



</div>
