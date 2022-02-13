<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" href="{{asset('img/recursos/logo-bowser.ico') }}"/>
        <link rel="stylesheet" type="text/css" href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">


    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Registro de Actividades
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{route('api.actividad_asignada')}}">
                                <input id="id" name="id" type="hidden" value="{{!isset($dV[0]->id) ? old('id') : $dV[0]->id }}">
                                <input  name="TipoOriginal" type="hidden" value="{{isset($dV[0]->tipo) ? $dV[0]->tipo : old('TipoOriginal') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="nombre" class="col-md-4 col-form-label text-md-right">nombre de la actividad</label>

                                    <div class="col-md-6">
                                        <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{isset($dV[0]->nombre) ? $dV[0]->nombre : old('nombre') }}" required autocomplete="nombre" autofocus>

                                        @error('nombre')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nombre" class="col-md-4 col-form-label text-md-right">tipo de actividad</label>
                                    <div class="col-md-6">
                                        <select name="tipo_actividad" id="tipo_actividad" onchange="Tact()">
                                            {{-- <option id="t_impresion" value='timpresion'>impresion</option> --}}
                                            <option id="t_software" value='tsoftware'>desarrollo de software</option>
                                            <option id="t_documentacion" value='tdocumentacion'>documentacion</option>
                                            <option id="t_actividades" value='tactividad'>otros</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nombre" class="col-md-4 col-form-label text-md-right">prestadores</label>
                                    <div class="col-md-6">
                                        <select class="duallistbox" @error('prestador') is-invalid @enderror" name="prestador" id="prestador" multiple="multiple" required >
                                            @if (isset($prestadores))
                                            @foreach ($prestadores as $prestador)
                                                <option value="{{$prestador->id}}" >{{$prestador->name}}</option>
                                             @endforeach
                                        @endif
                                        </select>
                                        @error('prestador')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">descripcion</label>

                                    <div class="col-md-6">
                                        <textarea id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{isset($dV[0]->descripcion) ? $dV[0]->descripcion : old('descripcion') }}" required autocomplete="descripcion" autofocus></textarea>

                                        @error('descripcion')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">objetivos</label>

                                    <div class="col-md-6">
                                        <textarea id="objetivo" type="text" class="form-control @error('objetivo') is-invalid @enderror" name="objetivo" value="{{isset($dV[0]->objetivo) ? $dV[0]->objetivo : old('objetivo') }}" required autocomplete="objetivo" autofocus></textarea>

                                        @error('objetivo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">fecha de entrega</label>
                                    <div class="col-md-6">
                                        <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                                            <input name="datepiker" type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#datetimepicker" autocomplete="off"/>
                                            <div class="input-group-append" data-target="#datetimepicker" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
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
    </body>

</html>

{{-- para que funcione todo, nota: este debe importarse primero si no, todo se chinga xd --}}

<script src={{asset('plugins/jquery/jquery.min.js')}}></script>

<!-- AdminLTE App -->
{{-- para que funcionen los componentes de adminlte como los botones laterales xd --}}
<script src={{asset('dist/js/adminlte.min.js')}}></script>

{{-- componentes necesarios para que funcione el dualistbox --}}
<script src={{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}></script>
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<script type="text/javascript">


        var demo1 = $('select[name="prestador"]').bootstrapDualListbox({

        preserveSelectionOnMove: 'Mover ',
        moveAllLabel: 'Mover todo',
        removeAllLabel: 'Borrar todo'
  });


  $(function () {
            $('#datetimepicker').datetimepicker({ icons: { time: 'far fa-calendar' },
                daysOfWeekDisabled: [0],
                format: 'DD/MM/YYYY'});
        })

</script>
