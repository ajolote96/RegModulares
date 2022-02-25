<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


 <!-- Font Awesome -->
 <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
 <!-- daterange picker -->
 <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
 <!-- iCheck for checkboxes and radio inputs -->
 <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
 <!-- Tempusdominus Bootstrap 4 -->
 <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
 <!-- Select2 -->
 <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
  </head>
<body>
  <!-- Modal -->

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div>
                      <div class="card border-secondary">
                        <div class="card-header">
                          <h2>
                            Status de su Proyecto Modular
                        </h2>
                        </div>
                        <div class="card-body">

                            @if($status == 'denegado')

                            <h1> No esta habilitado el sistema de Registro de Modulares. </h1>

                            @endif

                            {{-- <a>{{ $status->status}}<a> --}}

                            <h2>{{ Auth::user()->status }}</h2>
                            @if (Auth::user()->status=="denegado")
                            <h4>Registra de nuevo tu proyecto Modular</h4>
                            @endif

                            @if (Auth::user()->status=="pendiente")
                            <h4>Esté al pendiente del estatus de tu Proyecto</h4>
                            @endif

                            @if (Auth::user()->status!="sin_registro")
                           <form method="POST" action="{{ route('admin.viewProyecto') }}">

                                @csrf

                                <input  name="id_usuario" type="hidden" value="{{Auth::user()->id}}">

                               <button type="submit">Descargar PDF</button>
                           </form>

                            @endif

                        </div>
                      </div>
                      <div class="card" style="background-color: #deefeebe">

                      </div>
                    </div>


        </div>
    </div>
</div>


<!-- Bootstrap 4 -->

<!-- AdminLTE App -->
<script src={{asset('dist/js/adminlte.min.js')}}></script>
<!-- Bootstrap 4 -->
<!-- DataTables  & Plugins -->
<script src={{asset('plugins/datatables/jquery.dataTables.min.js')}}></script>
<script src={{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}></script>
<script src={{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}></script>
<script src={{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}></script>
<script src={{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}></script>
<script src={{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}></script>
<script src={{asset('plugins/jszip/jszip.min.js')}}></script>
<script src={{asset('plugins/pdfmake/pdfmake.min.js')}}></script>
<script src={{asset('plugins/pdfmake/vfs_fonts.js')}}></script>
<script src={{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}></script>
<script src={{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}></script>
<script src={{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}></script>
<script src={{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}></script>
<script src={{asset('dist/js/adminlte.min.js')}}></script>
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<script type="text/javascript">

</script>

</body>
</html>
