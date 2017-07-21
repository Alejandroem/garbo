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
                        @foreach($bodegas as $bodega)
                        <option>{{$bodega}}</option>
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

    <div id="data" class="well" hidden>
        <div class="row">
            <div class="col-md-12 text-right">
                <label>Creado por: </label> <label id="usuario"></label>
            </div>
            <div class="col-md-12">
                <label>Numero de entrada: </label>  <label id="numeroentrada"></label>
            </div>
            <div class="col-md-12">
                <label>Tipo de documento: </label>  <label id="tipoentrada"></label>
            </div>
            <div class="col-md-12">
                <label>Fecha: </label> <label id="fechaentrada"></label>
            </div>
            <div class="col-md-12">
                <label>Descripcion: </label>  <label id="descripcion"></label>
            </div>
        </div>
    </div>


    <div id="opciones" class="panel panel-default" hidden>
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#opcionesmodificacion">Opciones de modificación</a>
            </h4>
        </div>
        <div id="opcionesmodificacion" class="panel-collapse collapse">
            <div class="panel-body">
                <form method="post" action="{{route('peticion.store')}}">
                    {{csrf_field()}}
                    <div class="row">
                        <input type='text' id="codigo" name="codigo"  hidden>
                        <input type='text' id="idUsuario" name="idUsuario" value="{{$usuario}}"  hidden>
                        <input type='text' id="empresa" name="empresa"  value="{{$empresa}}" hidden>
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group">
                                <label>Fecha: </label>
                                <div class='input-group date datetimepicker'>
                                    <input name="nuevafecha" id="nuevafecha" type='text' class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
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
@section('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function()
      {/*
            $( "#numero" ).autocomplete({
                source: function( request, response ) {
                    $.ajax( {
                        url: "/peticion/numero/autocomplete",
                        //                        dataType: "jsonp",
                        data: {
                            term: request.term,
                            empresa: {{$empresa}}
                    },
                           success: function( data ) {
                        response( data );
                    }
                } );
            },
                                        minLength: 1,
                                        select: function( event, ui ) {
                console.log( "Selected: " + ui.item.value + " aka " + ui.item.id );
            }
        });*/


        $('#search').submit(function( event ) {
            $("#error").hide();
            $("#opciones").hide();
            $("#data").hide();
            event.preventDefault();
            $.ajax({
                url: '/peticion/search/movimiento',
                type: 'post',
                data: $('form').serialize(), // Remember that you need to have your csrf token included
                dataType: 'json',
                success: function( _response ){
                    // Handle your response..
                    console.log(_response);
                    $("#data").show();
                    $("#numeroentrada").html(_response.Numero);
                    $("#codigo").val(_response.Numero);
                    $("#tipoentrada").html(_response.Tipo);
                    $("#fechaentrada").html(_response.Fecha);
                    $("#descripcion").html(_response.Observaciones);

                    $("#usuario").html(_response.Usuario);
                    if(_response.Usuario===""||_response.Usuario ===null)
                        $("#usuario").html("Indefinido");




                    $("#opciones").show();

                },
                error: function( _response ){
                    // Handle error
                    $("#error").show();
                    console.log(_response);
                }
            });
        });

        var table = $('#dataTablesPeticiones').DataTable({
            responsive: true
        });

        $('#min, #max').keyup( function() {
            table.draw();
        } );

        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var min = Date.parse( $('#min').val(),"01/01/1800");
                var max = Date.parse( $('#max').val(),"12/12/999");
                var date = Date.parse( data[0] ) || "01/02/1800"; // use data for the age column

                if ( ( isNaN( min ) && isNaN( max ) ) ||
                    ( isNaN( min ) && date <= max ) ||
                    ( min <= date   && isNaN( max ) ) ||
                    ( min <= date   && date <= max ) )
                {
                    return true;
                }
                return false;
            }
        );

    });

</script>

@endsection