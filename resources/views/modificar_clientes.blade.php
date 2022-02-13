<div class="container">


    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Modificar Registro de Modular</h3>
                </div>
                <div class="card-body">

                    <form class="from-prevent-multiple-submits" method="POST" action="{{ route('cliente.ActualizarCita') }}"  enctype="multipart/form-data">

                    @csrf
                        <h3>Informacion del Proyecto</h3>
                        <input id="id" name="id_usuario" type="hidden" value="{{ Auth::user()->id }}">
                        <input id="id" name="id_modular" type="hidden" value="{{ $info[0]->id_modular }}">

                        <div class="form-group">
                            <label for="">Nombre del Representante</label>
                            <input type="text" class="form-control @error('r_nombre') is-invalid @enderror" name="r_nombre" id="r_nombre" aria-describedby="emailHelpId"  value="{{ Auth::user()->name }} ">
                            @error('r_nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Apellidos del Representante</label>
                            <input type="text" class="form-control @error('r_apellido') is-invalid @enderror" name="r_apellido" id="r_apellido" aria-describedby="emailHelpId"  value="{{ Auth::user()->apellido }} ">
                            @error('r_apellido')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Codigo del Representante</label>
                            <input type="text" class="form-control @error('r_codigo') is-invalid @enderror" name="r_codigo" id="r_codigo" aria-describedby="emailHelpId"  value="{{ Auth::user()->codigo }} ">
                            @error('r_codigo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="">Titulo del Proyecto</label>
                            <input type="text" class="form-control @error('Titulo') is-invalid @enderror" name="Titulo" id="Titulo" aria-describedby="emailHelpId"  value="{{old('Titulo',$info[0]->Titulo )  }}">
                            @error('Titulo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Area de Participacion</label>
                            <select class="form-control @error('Area_participacion') is-invalid @enderror" name="Area_participacion" id="Area_participacion">
                                <option value='Ambiente' {{old('Area_participacion') == 1 ? 'selected="selected"' : ''}}>Ambiente</option>
                                <option value='Conocimiento_del_Universo' {{old('Area_participacion') == 2 ? 'selected="selected"' : ''}}>Conocimiento del Universo</option>
                                <option value='Educacion' {{old('Area_participacion') == 3 ? 'selected="selected"' : ''}}>Educacion</option>
                                <option value='Desarrollo_Sustentable' {{old('Area_participacion') == 4 ? 'selected="selected"' : ''}}>Desarrollo Sustentable</option>
                                <option value='Desarrollo_Tecnologico' {{old('Area_participacion') == 5 ? 'selected="selected"' : ''}}>Desarrollo Tecnologico</option>
                                <option value='Energia' {{old('Area_participacion') == 6 ? 'selected="selected"' : ''}}>Energia</option>
                                <option value='Salud' {{old('Area_participacion') == 7 ? 'selected="selected"' : ''}}>Salud</option>
                                <option value='Sociedad' {{old('Area_participacion') == 8 ? 'selected="selected"' : ''}}>Sociedad</option>
                            </select>
                            @error('Area_participacion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Integrantes del Equipo</label>
                            <select class="form-control @error('equipo') is-invalid @enderror" name="equipo" id="equipo" onchange="javascript:showContent()">
                                <option value=1>1</option>
                                <option value=2 id="e2">2</option>
                                <option value=3 id="e3">3</option>
                            </select>
                            @error('equipo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div id="equipo2" style="display: none">
                            <h3>Miembro del equipo 2</h3>
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text"
                                class="form-control @error('Nombre_1') is-invalid @enderror" name="Nombre_1" id="Nombre_1" aria-describedby="helpId" value="{{$info[0]->Codigo_1}}">
                                @error('Nombre_1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Codigo</label>
                                <input type="number"
                                class="form-control @error('Codigo_1') is-invalid @enderror" name="Codigo_1" id="Codigo_1" aria-describedby="helpId" value="{{$info[0]->Codigo_1}}">
                                @error('Codigo_1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Carrera</label>
                                <input type="text"
                                class="form-control @error('Carrera_1') is-invalid @enderror" name="Carrera_1" id="Carrera_1" aria-describedby="helpId" value="{{$info[0]->Carrera_1}}">
                                @error('Carrera_1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Correo</label>
                                <input type="email"
                                class="form-control @error('Correo_1') is-invalid @enderror" name="Correo_1" id="Correo_1" aria-describedby="helpId" value="{{$info[0]->Correo_1}}">
                                @error('Correo_1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div id="equipo3" style="display: none">
                            <h3>Miembro del equipo 3</h3>
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text"
                                class="form-control @error('Nombre_2') is-invalid @enderror" name="Nombre_2" id="Nombre_2" aria-describedby="helpId" value="{{$info[0]->Nombre_2}}">
                                @error('Nombre_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Codigo</label>
                                <input type="number"
                                class="form-control @error('Codigo_2') is-invalid @enderror" name="Codigo_2" id="Codigo_2" aria-describedby="helpId" value="{{$info[0]->Codigo_2}}">
                                @error('Codigo_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Carrera</label>
                                <input type="text"
                                class="form-control @error('Carrera_2') is-invalid @enderror" name="Carrera_2" id="Carrera_2" aria-describedby="helpId" value="{{$info[0]->Carrera_2 }}">
                                @error('Carrera_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Correo</label>
                                <input type="email"
                                class="form-control @error('Correo_2') is-invalid @enderror" name="Correo_2" id="Correo_2" aria-describedby="helpId" value="{{$info[0]->Correo_2 }}">
                                @error('Correo_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <h3>Asesor</h3>
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text"
                            class="form-control @error('asesor_nombre_1') is-invalid @enderror" name="asesor_nombre_1" id="asesor_nombre_1" aria-describedby="helpId" value="{{$info[0]->asesor_nombre_1 }}">
                            @error('asesor_nombre_1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Codigo</label>
                            <input type="number"
                            class="form-control @error('asesor_codigo_1') is-invalid @enderror" name="asesor_codigo_1" id="asesor_codigo_1" aria-describedby="helpId" value="{{$info[0]->asesor_codigo_1 }}">
                            @error('asesor_codigo_1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Departamento</label>
                            <input type="text"
                            class="form-control @error('asesor_departamento_1') is-invalid @enderror" name="asesor_departamento_1" id="asesor_departamento_1" aria-describedby="helpId" value="{{$info[0]->asesor_departamento_1 }}">
                            @error('asesor_departamento_1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Correo</label>
                            <input type="email"
                            class="form-control @error('asesor_correo_1') is-invalid @enderror" name="asesor_correo_1" id="asesor_correo_1" aria-describedby="helpId" value="{{$info[0]->asesor_correo_1 }}">
                            @error('asesor_correo_1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tienes Asesor Externo?</label>
                            <select class="form-control @error('asesor') is-invalid @enderror" name="asesor" id="asesor" onchange="javascript:showContent()">
                                <option value='no'>no</option>
                                <option value='si' id="as">si</option>
                            </select>
                            @error('asesor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div id="asesor-e" style="display: none">
                            <h3>2do Asesor</h3>
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text"
                                class="form-control @error('asesor_nombre_2') is-invalid @enderror" name="asesor_nombre_2" id="asesor_nombre_2" aria-describedby="helpId" value="{{$info[0]->asesor_nombre_2 }}">
                                @error('asesor_nombre_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Codigo</label>
                                <input type="number"
                                class="form-control @error('asesor_codigo_2') is-invalid @enderror" name="asesor_codigo_2" id="asesor_codigo_2" aria-describedby="helpId" value="{{$info[0]->asesor_codigo_2 }}">
                                @error('asesor_codigo_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Departamento</label>
                                <input type="text"
                                class="form-control @error('asesor_departamento_2') is-invalid @enderror" name="asesor_departamento_2" id="asesor_departamento_2" aria-describedby="helpId" value="{{$info[0]->asesor_departamento_2 }}">
                                @error('asesor_departamento_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Correo</label>
                                <input type="email"
                                class="form-control @error('asesor_correo_2') is-invalid @enderror" name="asesor_correo_2" id="asesor_correo_2" aria-describedby="helpId" value="{{$info[0]->asesor_correo_2 }}">
                                @error('asesor_correo_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Resumen del Proyecto</label>
                            <textarea class="form-control @error('resumen') is-invalid @enderror" name="resumen" id="resumen" rows="5" >{{$info[0]->resumen }}</textarea>
                            @error('resumen')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Justificación del Modulo 1</label>
                            <textarea class="form-control @error('justificacion_m1') is-invalid @enderror" name="justificacion_m1" id="justificacion_m1" rows="5" >{{$info[0]->justificacion_m1 }}</textarea>
                            @error('justificacion_m1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Justificación del Modulo 2</label>
                            <textarea class="form-control @error('justificacion_m2') is-invalid @enderror" name="justificacion_m2" id="justificacion_m2" rows="5" >{{$info[0]->justificacion_m2 }}</textarea>
                            @error('justificacion_m2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Justificación del Modulo 3</label>
                            <textarea class="form-control @error('justificacion_m3') is-invalid @enderror" name="justificacion_m3" id="justificacion_m3" rows="5" >{{$info[0]->justificacion_m3 }}</textarea>
                            @error('justificacion_m3')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Actividades a Realizar de Cada Integrante</label>
                            <textarea class="form-control @error('actividad_integrantes') is-invalid @enderror" name="actividad_integrantes" id="actividad_integrantes" rows="5" >{{$info[0]->actividad_integrantes }}</textarea>
                                @error('actividad_integrantes')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <div class="col-md-12 text-right" >
                            <button style="" type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits ">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function showContent() {
        element = document.getElementById("equipo2");
        element2 = document.getElementById("equipo3");
        element3 = document.getElementById("asesor-e");
        check = document.getElementById("e2");
        check2 = document.getElementById("e3");
        check3 = document.getElementById("as");
        if (check.selected) {
            element.style.display='block';
            element2.style.display='none';
        }else if(check2.selected){
            element.style.display='block';
            element2.style.display='block';
        }else if(check3.selected){
            element3.style.display='block';
        }
        else {
            element.style.display='none';
            element2.style.display='none';
            element3.style.display='none';
        }
    }
    </script>
