<!-- Button trigger modal -->
<!--
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
Launch demo modal
</button>
-->

<!-- Modal -->
<div class="modal fade" id="modal-{{$peticion->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Peticion No: {{$peticion->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modal-form-{{$peticion->id}}" class="modal-form" data-id="{{$peticion->id}}" method="post" action="{{route('peticion.update',$peticion->id)}}">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">

                                <label>Nueva fecha: </label>
                            </div>
                            <div class="col-md-6">
                                <div  class='input-group date datetimepicker'>
                                    <input  id="modal-form-fecha-{{$peticion->id}}"

                                           name="nuevafecha" type='text' class="form-control" value="{{Carbon\Carbon::parse($peticion->campos->first()->valorNuevo)->format('d/m/Y')}}"
                                           @if($peticion->estado==1) 
                                    disabled
                                    @endif
                                    />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button class="continuar btn btn-primary" type="submit" data-dismiss="modal">Continuar</button>
                </div>
            </form>
        </div>
    </div>
</div>  