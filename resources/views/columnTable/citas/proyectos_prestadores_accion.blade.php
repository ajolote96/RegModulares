
<div class="row">

    <form  method="POST" action="{{ route('api.impresion_terminada') }}">

        <input  name="id_impresion" type="hidden" value="{{ $id_impresion }}">
        <input  name="id_impresion_prestador" type="hidden" value="{{ $id_impresion_prestador }}">

        <button type="submit" id='eli' class="btn btn-success">Proyecto Terminado</button>
        @csrf
    </form>

    <form>

        <input  name="descargaName" type="hidden" value="">

        <button type="submit" id='eli' class="btn btn-danger">borrar</button>
        @csrf
    </form>


</div>
