

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reporte </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form method="POST" action="{{ route('nota') }}">
                @csrf
            <div class="modal-body">
                <input id="modalid" name="id" type="hidden" >
                <textarea name="nota" class="form-control" id="myTextarea"  maxlength="255">
                </textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="guardarBtn">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>

@if($nota == "")
    <button type="button" class="btn btn-primary btn-sm" style="background-color:red" data-toggle="modal" data-target="#modelId" onclick="mymodal('{{$nota}}','{{$id}}','{{$fechaQ}}','{{$fecha}}','{{$origen}}')" >Nota</button>
@else
    <button type="button" class="btn btn-primary btn-sm" style="background-color:green" data-toggle="modal" data-target="#modelId" onclick="mymodal('{{$nota}}','{{$id}}','{{$fechaQ}}','{{$fecha}}','{{$origen}}')" >Nota</button>

@endif

<script type="text/javascript">
  function mymodal(nota,id,fecha,fechaAct, origen){
    $('#modelId').modal({
        keyboard: true,
        backdrop: "static",
        show:false,

    })
        //make your ajax call populate items or what even you need
    document.getElementById("myTextarea").value = nota;
    document.getElementById("modalid").value = id;
    // if((fecha != fechaAct) || ("{{ Auth::user()->tipo }}" == "prestador"  || ("{{ Auth::user()->tipo }}" == "Superadmin" && origen != 'Superadmin' ) || ("{{ Auth::user()->tipo }}" == "admin" && origen != 'checkin' ))){
    if("{{ Auth::user()->tipo }}" == "prestador"){
        document.getElementById("guardarBtn").disabled = true;
        document.getElementById("myTextarea").readOnly = true;
    }
    else{
        document.getElementById("guardarBtn").disabled = false;
        document.getElementById("myTextarea").readOnly = false;
    }
}

</script>
