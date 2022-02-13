<div class="modal fade" id="modelact" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Informacion del Proyecto Modular </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>

            <div class="modal-body">
                <label>Titulo</label>
                    <p  id="Titulo" name="idact"><p>
                    <label>Area de participación</label>
                    <p  id="Area_participacion" name="nombreact"><p>
                    <label>Resumen</label>
                    <p  id="resumen" name="tipoact"></p>
                    <label>Justificación del Modulo 1</label>
                    <p  id="justificacion_m1" name="prestadoract"></p>
                    <label>Justificación del Modulo 2</label>
                    <p  id="justificacion_m2" name="descact"></p>
                    <label>Justificación del Modulo 3</label>
                    <p  id="justificacion_m3" name="objact"></p>
                    <br>

                    <label>Actividades de los integrantes</label>
                    <p  id="actividad_integrantes" name="objact"></p>
                    <br>

                    <h4>Jefe de equipo</h4>
                    <label>Codigo del integrante 1</label>
                    <p  id="codigo" name="fecha"></p>
                    <label>Nombre</label>
                    <p  id="nombre_alumno" name="statusact"></p>
                    <label>Apellido</label>
                    <p  id="apellido" name="statusact"></p>
                    <label>Correo</label>
                    <p  id="correo" name="statusact"></p>
                    <br>

                    <h4>Integrante 2</h4>
                    <label>Codigo del integrante 2 (en caso de existir)</label>
                    <p  id="Codigo_1" name="fecha"></p>
                    <label>Nombre Completo</label>
                    <p  id="Nombre_1" name="statusact"></p>
                    <label>Carrera</label>
                    <p  id="Carrera_1" name="statusact"></p>
                    <label>Correo</label>
                    <p  id="Correo_1" name="statusact"></p>
                    <br>

                    <h4>Integrante 3</h4>
                    <label>Codigo del integrante 3 (en caso de existir)</label>
                    <p  id="Codigo_2" name="fecha"></p>
                    <label>Nombre Completo</label>
                    <p  id="Nombre_2" name="statusact"></p>
                    <label>Carrera</label>
                    <p  id="Carrera_2" name="statusact"></p>
                    <label>Correo</label>
                    <p  id="Correo_2" name="statusact"></p>
                    <br>

                    <h4>Asesor 1</h4>
                    <label>Codigo del asesor</label>
                    <p  id="asesor_codigo_1" name="fecha"></p>
                    <label>Nombre Completo</label>
                    <p  id="asesor_nombre_1" name="statusact"></p>
                    <label>Departamento</label>
                    <p  id="asesor_departamento_1" name="statusact"></p>
                    <label>Correo</label>
                    <p  id="asesor_correo_1" name="statusact"></p>
                    <br>

                    <h4>Asesor 2</h4>
                    <label>Codigo del asesor 2 (en caso de existir)</label>
                    <p  id="asesor_codigo_2" name="fecha"></p>
                    <label>Nombre Completo</label>
                    <p  id="asesor_nombre_2" name="statusact"></p>
                    <label>Departamento</label>
                    <p  id="asesor_departamento_2" name="statusact"></p>
                    <label>Correo</label>
                    <p  id="asesor_correo_2" name="statusact"></p>
                    <br>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


            </div>

        </div>

    </div>

</div>

<button type="button" class="btn btn-info"data-toggle="modal" data-target="#modelact" onclick="modalact({{json_encode($info)}})">
    ver
</button>


<form  method="POST" action="{{ route('admin.AprobarProyecto') }}">

    <input  name="id_alumno" type="hidden" value="{{$info->id_alumno}}">
    <input  name="correo" type="hidden" value="{{$info->correo}}">
    <input  name="nombre_alumno" type="hidden" value="{{$info->nombre_alumno}}">
    <input  name="id_modular" type="hidden" value="{{$info->id_modular}}">
    <input  name="titulo" type="hidden" value="{{$info->Titulo}}">

    <button type="submit" class="btn btn-success" >Aprobar</button>
    @csrf
</form>

<form  method="POST" action="{{ route('admin.RechazarProyecto') }}">

    <input  name="id_alumno" type="hidden" value="{{$info->id_alumno}}">
    <input  name="id_modular" type="hidden" value="{{$info->id_modular}}">

    <button type="submit" class="btn btn-danger" >Rechazar</button>
    @csrf
</form>



<script>
    function modalact(actividad){
    $('#modelact').modal({
        keyboard: true,
        backdrop: "static",
        show:false,
    })


    document.getElementById("Titulo").innerHTML = actividad['Titulo'];
    document.getElementById("Area_participacion").innerHTML = actividad['Area_participacion'];

    document.getElementById("resumen").innerHTML = actividad['resumen'];
    document.getElementById("justificacion_m1").innerHTML = actividad['justificacion_m1'];
    document.getElementById("justificacion_m2").innerHTML = actividad['justificacion_m2'];
    document.getElementById("justificacion_m3").innerHTML = actividad['justificacion_m3'];

    document.getElementById("actividad_integrantes").innerHTML = actividad['actividad_integrantes'];

    document.getElementById("codigo").innerHTML = actividad['codigo'];
    document.getElementById("nombre_alumno").innerHTML = actividad['nombre_alumno'];
    document.getElementById("apellido").innerHTML = actividad['apellido'];
    document.getElementById("correo").innerHTML = actividad['correo'];

    document.getElementById("Codigo_1").innerHTML = actividad['Codigo_1'];
    document.getElementById("Nombre_1").innerHTML = actividad['Nombre_1'];
    document.getElementById("Correo_1").innerHTML = actividad['Correo_1'];
    document.getElementById("Carrera_1").innerHTML = actividad['Carrera_1'];

    document.getElementById("Codigo_2").innerHTML = actividad['Codigo_2'];
    document.getElementById("Nombre_2").innerHTML = actividad['Nombre_2'];
    document.getElementById("Correo_2").innerHTML = actividad['Correo_2'];
    document.getElementById("Carrera_2").innerHTML = actividad['Carrera_2'];

    document.getElementById("asesor_codigo_1").innerHTML = actividad['asesor_codigo_1'];
    document.getElementById("asesor_nombre_1").innerHTML = actividad['asesor_nombre_1'];
    document.getElementById("asesor_departamento_1").innerHTML = actividad['asesor_departamento_1'];
    document.getElementById("asesor_correo_1").innerHTML = actividad['asesor_correo_1'];

    document.getElementById("asesor_codigo_2").innerHTML = actividad['asesor_codigo_2'];
    document.getElementById("asesor_nombre_2").innerHTML = actividad['asesor_nombre_2'];
    document.getElementById("asesor_departamento_2").innerHTML = actividad['asesor_departamento_2'];
    document.getElementById("asesor_correo_2").innerHTML = actividad['asesor_correo_2'];






    document.getElementById("status").innerHTML = actividad['status'];

  }
</script>

