
    <!-- Modal delete-->
    <div class="modal fade" id="modeldelete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Registro de asistencia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" id="formeliminar" action="{{ route('api.eliminar') }}">
                        <input  id="opcionEliminar" name="opcion" type="hidden">
                        <input  id="idEliminar" name="id" type="hidden">
                        <input  id="tipoEliminar" name="TipoOriginal" type="hidden" >
                        @csrf
                        <p id="txtmodalEliminar">Hello World!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" id='eli' class="btn btn-danger">borrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<button type="button" class="btn btn-primary btn-sm" style="background-color:red" data-toggle="modal" data-target="#modeldelete"  onclick="modaleliminar('{{$id}}','{{$origen}}','{{$codigo}}','{{$origen}}')">
    Eliminar
</button>

<script type="text/javascript">
    function modaleliminar(id,tipo,nombre,opc){
        $('#modeldelete').modal({
            keyboard: true,
            backdrop: "static",
            show:false,
        })

        document.getElementById("idEliminar").value = id;
        document.getElementById("tipoEliminar").value = tipo;
        document.getElementById("txtmodalEliminar").innerHTML ='Usuario: ' + nombre;
        document.getElementById("opcionEliminar").value = opc;

    }
</script>
