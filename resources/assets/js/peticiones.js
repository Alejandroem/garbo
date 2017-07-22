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



    $('#dataTablesPeticiones tbody').on( 'click', 'tr', function () {
        console.log("click en"+$(this).data('id'));
        $('#modal-'+$(this).data('id')).modal('toggle');
    } );

    //    $(".continuar").on('click',function(){
    //        $('#modal-'+$(this).data('id')).modal('toggle');
    //    });

    $(document).on('click', '.button-delete', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var token = $(this).data("token");
        swal({
            title: '¿Está seguro que desea elminar la petición?',
            text: "No podrá deshacer los cambios",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText:'Cancelar'
        }).then(function () {
            swal(
                'Eliminado!',
                'Su peticion ha sido eliminada.',
                'success'
            )

            table
                .row( $(this).parents('tr') )
                .remove()
                .draw();

            $.ajax({
                url:"/peticion/"+id,
                type: 'post',
                data: {peticion:id, _method: 'delete', _token :token},
                success: function (data) {
                    console.log(data);
                    table.draw();

                }         
            });
        })
    });

    $('.modal-form').submit(function( event ) {
        var id = $(this).data('id');
        var token = $(this).data("token");
        var fecha = $("#modal-form-fecha-"+id).val();
        event.preventDefault();
        $.ajax({

            url: '/peticion/'+id,
            type: 'post',
            data: {peticion:id, _method: 'put', _token :token, nuevafecha:fecha},
            success: function( _response ){
                // Handle your response..
                alert(_response);
            },
            error: function( _response ){
                // Handle error

            }
        });

    });


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

    $(".datetimepicker").on('dp.change',function() {
        //console.log("bla");
        table.draw();
    } );

    $("#pendientes").change(function() {
        console.log('Toggle: ' + $(this).prop('checked'));
        table.draw();
    })

    $("#tipos").on('change', function (e) {
        table.draw();
        //            alert($("#tipos").val());
    });

    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {

            var from = $('#desde').val().split("/");
            var min = new Date(from[2], from[1] - 1, from[0]);

            var to =  $('#hasta').val().split("/");
            var max =  new Date(to[2], to[1] - 1, to[0]);

            var da = data[1].split("/");
            var date =  new Date(da[2], da[1] - 1, da[0]); // use data for the age column

            /*console.log(data[1]);
                console.log("min "+min.toDateString()+" max "+isNaN(max)+" date "+date.toDateString());
                console.log(min>date);*/


            var retValue = true;
            if ((!isNaN(max) && date > max ) || ( !isNaN(min) && min > date ))
            {
                retValue = false;
                console.log("hola desde fechas");
            }

            if($("#tipos").val()!==""){
                if($("#tipos").val() !== data[2]){
                    retValue = false;
                    console.log("hola desde tipos");
                }
            }

            if($("#pendientes").prop('checked')){
                if(data[3]!=="Pendiente"){
                    retValue = false;
                    console.log("hola desde pendientes");
                }
            }

            return retValue;
        }
    );

});

