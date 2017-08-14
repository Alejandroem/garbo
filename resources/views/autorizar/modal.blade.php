<!-- Button trigger modal -->

<a style="color: inherit;text-decoration: none;" data-toggle="modal" data-target="#modal-{{$peticion->id}}">
<i class="material-icons">visibility</i>
</a>


<!-- Modal -->
<div class="modal fade" id="modal-{{$peticion->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Peticion No: {{$peticion->Codigo}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">

                            <label>Nueva Fecha: </label>
                        </div>
                        <div class="col-md-6">
                            <div  class='input-group date datetimepicker'>
                                <input  id="modal-form-fecha-{{$peticion->id}}"

                                       name="modalnuevafecha" type='text' class="form-control" value="{{Carbon\Carbon::parse($peticion->campos->first()->valorNuevo)->format('d/m/Y')}}"
                                       disabled

                                       />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="clearfix"></div>
                        <div class="col-md-4">

                            <label>Solicitante: </label>
                        </div>

                        <div class="col-md-6">
                            {{$peticion->idUsuario}}
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="clearfix"></div>
                        <div class="col-md-4">

                            <label>Fecha de solicitud: </label>
                        </div>
                        <div class="col-md-6">
                            {{Carbon\Carbon::parse($peticion->fechaCreacion)->format('d/m/Y')}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                @if($peticion->estado==0)
                <a href="{{route('peticion.aprobar',['peticion'=>$peticion->id])}}" class="btn btn-success">Aprobar</a>
                <a href="{{route('peticion.denegar',['peticion'=>$peticion->id])}}" class="btn btn-danger">Denegar</a>
                @endif
            </div>
        </div>
    </div>
</div>  