<input  name="id" type="hidden" value="{{$id}}">
<input  name="TipoOriginal" type="hidden" value="{{$tipo}}">
<a id='mod' class="btn btn-info" href="/admin/modificar?id={{$id}}" >editar</a>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modeldelete" onclick="modaleliminar('{{$id}}','{{$tipo}}','{{$name}}','usuario')">borrar</button>
@if($tipo == 'prestador')
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalhoras" onclick="modalhoras('{{$id}}', '{{$name}}')">Asignar horas</button>
@endif
