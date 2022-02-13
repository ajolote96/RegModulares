@extends('layouts.app')

@section('content')

<div class="container">
  <div class="card-deck mb-3 ">
    <div class="card mb-4 box-shadow">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal text-center" >{{ __('Login') }}</h4>
      </div>
      <div class="card-body">
        @if(Session::has('status'))
        <div class="alert alert-warning" role="alert">
          <strong>{{ Session::get('status') }}</strong>
        </div>
        @endif
        <ul class="list-unstyled mt-3 mb-4">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input id="opc" name="opc" type="hidden" value="0">
                <div class="form-group row">
                    <label  class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

                    <div class="col-md-6">
                        <input id="correo" type='email'  class="form-control @if(old('opc')=='0') @error('correo') is-invalid @enderror @endif" name="correo" value="{{ old('opc')=='0' ? old('correo') : '' }}">
                        @if(old('opc')=='0')
                        @error('correo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @endif

                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @if(old('opc')=='0') @error('password') is-invalid @enderror @endif" name="password"  autocomplete="current-password">
                        @if(old('opc')=='0')
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @endif
                    </div>
                </div>


        </ul>

        <button  type="submit" class="btn btn-lg btn-block btn-primary">{{ __('Iniciar Sesion') }}</button>
        <a class="btn btn-link" href="{{route('password.request')}}">
            {{ __('Recuperar Contraseña') }}
        </a>
    </form>
      </div>
    </div>
    <div class="card mb-4 box-shadow">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal text-center">{{ __('Registro del Representante de equipo') }}</h4>
      </div>
      <div class="card-body">
        @if(Session::has('statusC'))
        <div class="alert alert-success" role="alert">
          <strong>{{ Session::get('statusC') }}</strong>
        </div>
        @endif
        <ul class="list-unstyled mt-3 mb-4">
            <form method="POST" action="{{isset($ruta) ?  route($ruta) :route('registrar')}}">
                <input id="id" name="id" type="hidden" value="{{!isset($dV[0]->id) ? '' : $dV[0]->id }}">
                <input id="opc" name="opc" type="hidden" value="1">
                <input  name="TipoOriginal" type="hidden" value="{{isset($dV[0]->tipo) ? $dV[0]->tipo : '' }}">
                @csrf
                <div class="form-check row">
                    <input type="checkbox" style="opacity:0; position:absolute;" class="form-check-input" type="hidden" id="alumnoCheck" name="alumnoCheck" value="1" onchange="caseAlumno()" >

                </div>



                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre(s)') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{!isset($dV[0]->name) ? old('name') : $dV[0]->name }}" autocomplete="name">
                        @if(old('opc')=='1')
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="apellido" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>

                    <div class="col-md-6">
                        <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('opc')=='1' ? old('apellido') : '' }}" required autocomplete="apellido" >
                        @if(old('opc')=='1')
                        @error('apellido')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

                    <div class="col-md-6">
                        <input id="correo" type="email" class="form-control @if(old('opc')=='1') @error('correo') is-invalid @enderror @endif"  name="correo" value="{{ old('opc')=='1' ? old('correo') : '' }}" >
                        @if(old('opc')=='1')
                        @error('correo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @endif


                    </div>
                </div>

                {{-- <div class="form-group row">

                    <label  class="col-md-4 col-form-label text-md-right">{{ __('Tipo de usuario') }}</label>
                    <div class="col-md-6"> --}}
                        {{-- <select  class="form-control" name="tipo" id="tipo" onchange="cambiarRB()">

                            <option id="RBcliente" value='clientes' {{old('tipo') == "clientes" ? 'selected="selected"' : '' }}>Visitante</option>

                            <option id="RBprestador" value='prestadorp' {{old('tipo') == "prestadorp" ? 'selected="selected"' : '' }}>Prestador</option>

                        </select> --}}
                        <input type="hidden" name="tipo" id="tipo" value="clientes">
                     {{-- </div>
                </div> --}}

                <div id="divcaseVisitante" style="display: none">
                    <div class="form-group row">

                        <label  class="col-md-4 col-form-label text-md-right">{{ __('Tipo de visitante') }}</label>
                        <div class="col-md-6">
                            <select  class="form-control" name="tipo_cliente" id="tipoV" onchange="cambiarRB()">

                                <option id="RBCAlumno" value='Alumno' {{old('tipo_cliente') == "Alumno" ? 'selected="selected"' : '' }}>Alumno</option>

                                <option id="RBCMaistro" value='Maestro' {{old('tipo_cliente') == "Maestro" ? 'selected="selected"' : '' }}>Maestro</option>
                                <option id="RBCOtro" value='Otro' {{old('tipo_cliente') == "Otro" ? 'selected="selected"' : '' }}>Otro</option>

                            </select>

                         </div>
                    </div>
                </div>

                <div id="divAlumno" >
                    <div class="form-group row">
                        <label  class="col-md-4 col-form-label text-md-right">{{ __('Codigo') }}</label>

                        <div class="col-md-6">
                            <input id="codigo"  class="form-control @if(old('opc')=='1') @error('codigo') is-invalid @enderror @endif" name="codigo" value="{{ old('codigo') }} " >
                            @if(old('opc')=='1')
                            @error('codigo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @endif

                        </div>
                    </div>

                        {{-- <label  class="col-md-4 col-form-label text-md-right">{{ __('Carrera') }}</label> --}}

                        <input id="carrera" name="carrera" type="hidden" value="Ingenieria en computación">

                        {{-- <div class="col-md-6">
                            <select class="form-control @if(old('opc')=='1') @error('carrera') is-invalid @enderror @endif" name="carrera" id="carrera" >
                                @if (isset($carreras))
                                <option id="carreranull" value="{{null}}" {{isset($dV[0]->carrera) ? $dV[0]->carrera == null ? 'selected="selected"' : '' : ''}}></option>
                                @foreach ($carreras as $dato )
                                <option id="{{$dato->carrera}}" value="{{$dato->carrera}}" {{old('carrera') == $dato->carrera ? 'selected="selected"' : '' }}>{{$dato->carrera}}</option>

                                @endforeach

                                @endif

                            </select>
                            @if(old('opc')=='1')
                            @error('carrera')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @endif

                        </div> --}}





                </div>
                <div id="divhoras" class="form-group row" style="display: none">
                    <label  class="col-md-4 col-form-label text-md-right">{{ __('Horas de servicio') }}</label>

                    <div class="col-md-6">
                        <input id="horas" type="number" class="form-control @if(old('opc')=='1') @error('horas') is-invalid @enderror @endif " name="horas" value="{{old('horas')}}">
                        @if(old('opc')=='1')
                            @error('horas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @endif

                    </div>
                </div>




                @if (isset($nombre))

                    @if($nombre != 'Modificar')

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @if(old('opc')=='1') @error('password') is-invalid @enderror @endif" name="password" autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>
                    @endif

                @endif
        </ul>
        <button type="submit" class="btn btn-lg btn-block btn-primary">{{ __('Registrar') }}</button>
    </form>


      </div>

    </div>

  </div>
  {{-- <button  class="btn btn-lg btn-block btn-primary" href="{{ route('admin.firmas') }}">bot</button> --}}
</div>


<script src={{asset('plugins/jquery/jquery.min.js')}}></script>
<!-- Bootstrap 4 -->
<script src={{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}></script>
<!-- AdminLTE App -->
<script src={{asset('dist/js/adminlte.min.js')}}></script>
<script type="text/javascript">

$(document).ready(function(){

    cambiarRB();
    caseAlumno();
});
function caseAlumno(){
    var divalumno = document.getElementById('divAlumno');
    var horas = document.getElementById('horas');

    if(document.getElementById('alumnoCheck').checked ){
        divalumno.style.display = "";
    }else{
        divalumno.style.display = "none";


    }
}
function cambiarRB(){
    var divhoras = document.getElementById('divhoras');
    var horas = document.getElementById('horas');
    var caseV = document.getElementById('divcaseVisitante');
    var caseVOtro = document.getElementById('RBCOtro');
    var divalumno = document.getElementById('divAlumno');
    if(document.getElementById('RBprestador').selected) {
        document.getElementById("alumnoCheck").checked = true;
        divhoras.style.display = "";
        caseV.style.display = 'none';
        caseAlumno();
      }else {
        divhoras.style.display = "none";
        caseV.style.display = '';

        if(caseVOtro.selected){
            divalumno.style.display = "none";

        }else{
            divalumno.style.display = "";

        }
      }
      if(document.getElementById('RBCAlumno').selected){
        document.getElementById('alumnoCheck').checked = 'checked';
      }
      if(document.getElementById('RBCMaistro').selected){
        document.getElementById('alumnoCheck').checked = 'checked';
      }
}
</script>
@endsection
