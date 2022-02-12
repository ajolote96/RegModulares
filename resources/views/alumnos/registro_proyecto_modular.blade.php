@extends('alumnos.alumnos-index')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Registro de Proyectos modulares
                    </div>
                    <div class="card-body">
                        <form>
                            <h3>Informacion del Proyecto</h3>
                            <div class="form-group row">
                            <label for=""> Titulo del Proyecto</label>
                            <div class="col-md-6">
                                <input type="text"
                                class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                            </div>
                            </div>
                            <div class="form-group">
                            <label for="">Area de Participacion</label>
                            <div class="col-md-6">
                                <select class="form-control" name="" id="">
                                    <option>Ambiente</option>
                                    <option>Conocimiento del Universo</option>
                                    <option>Educacion</option>
                                    <option>Desarrollo Sustentable</option>
                                    <option>Desarrollo Tecnologico</option>
                                    <option>Energia</option>
                                    <option>Salud</option>
                                    <option>Sociedad</option>
                                </select>
                            </div>
                            </div>
                            <h3>Integrantes del Equipo</h3>
                            <div class="form-group">
                                <label for="">Numero de Integrantes  del Equipo</label>
                                <div class="col-md-6">
                                <select class="form-control" name="equipos" id="equipos" onchange="javascript:showContent()">
                                    <option>1</option>
                                    <option id="e2" value="2">2</option>
                                    <option id="e3" value="3">3</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="">Nombre Completo</label>
                                <div class="col-md-6">
                                <input type="text"
                                class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="">Codigo</label>
                                <div class="col-md-6">
                                <input type="text"
                                class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row" style="display: none">
                                <label for="">Carrera</label>
                                <div class="col-md-6">
                                <input type="text" value="Ingenieria en Computacion"
                                class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="">Correo</label>
                                <div class="col-md-6">
                                <input type="text"
                                class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                </div>
                            </div>
                            <div id="equipo2" style="display: none">
                                <div class="form-group row">
                                    <label for="">Nombre Completo</label>
                                    <div class="col-md-6">
                                    <input type="text"
                                    class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="">Codigo</label>
                                    <div class="col-md-6">
                                    <input type="text"
                                    class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="">Carrera</label>
                                    <div class="col-md-6">
                                    <input type="text"
                                    class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="">Correo</label>
                                    <div class="col-md-6">
                                    <input type="text"
                                    class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div id="equipo3" style="display: none">
                                <div class="form-group row">
                                    <label for="">Nombre Completo</label>
                                    <div class="col-md-6">
                                    <input type="text"
                                    class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="">Codigo</label>
                                    <div class="col-md-6">
                                    <input type="text"
                                    class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="">Carrera</label>
                                    <div class="col-md-6">
                                    <input type="text"
                                    class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="">Correo</label>
                                    <div class="col-md-6">
                                    <input type="text"
                                    class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <h3>Asesor</h3>
                            <div class="form-group row">
                                <label for="">Nombre Completo</label>
                                <div class="col-md-6">
                                <input type="text"
                                class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="">Codigo</label>
                                <div class="col-md-6">
                                <input type="text"
                                class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="">Departamento</label>
                                <div class="col-md-6">
                                <input type="text"
                                class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="">Correo</label>
                                <div class="col-md-6">
                                <input type="text"
                                class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Tienes Asesor externo al Departamento</label>
                                <div class="col-md-6">
                                <select class="form-control" name="asesor" id="asesor" onchange="javascript:showContent()">
                                    <option>no</option>
                                    <option id="as" value="si">si</option>
                                </select>
                                </div>
                            </div>
                            <div id="asesor-e" style="display: none">
                                <div class="form-group row">
                                    <label for="">Nombre Completo</label>
                                    <div class="col-md-6">
                                    <input type="text"
                                    class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="">Codigo</label>
                                    <div class="col-md-6">
                                    <input type="text"
                                    class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="">Departamento</label>
                                    <div class="col-md-6">
                                    <input type="text"
                                    class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="">Correo</label>
                                    <div class="col-md-6">
                                    <input type="text"
                                    class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <h3>Resumen del Proyecto</h3>
                            <div class="form-group row">
                            <label for="">Resumen</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="" id="" rows="5"></textarea>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="">Justificacion Modulo 1</label>
                                <div class="col-md-6">
                                <textarea class="form-control" name="" id="" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="">Justificacion Modulo 2</label>
                                <div class="col-md-6">
                                <textarea class="form-control" name="" id="" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="">Justificacion Modulo 3</label>
                                <div class="col-md-6">
                                <textarea class="form-control" name="" id="" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="">Actividadesd a realizar de cada integrante</label>
                                <div class="col-md-6">
                                <textarea class="form-control" name="" id="" rows="5"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-lg btn-block btn-primary">Enviar Registro</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src={{asset('vendor/jquery/jquery.min.js')}}></script>
    <!-- Bootstrap 4 -->
    <script src={{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}></script>
    <!-- AdminLTE App -->
    <script src={{asset('vendor/adminlte/dist/js/adminlte.min.js')}}></script>
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
@endsection