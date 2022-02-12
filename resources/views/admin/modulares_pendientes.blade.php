<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href={{asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback')}}>

    <link rel="stylesheet" href={{asset('vendor/fontawesome-free/css/all.min.css')}}>

    <link rel="stylesheet" href={{ asset('vendor/bootstrap/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('vendor/bootstrap/datatables-responsive/css/responsive.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('vendor/bootstrap/datatables-buttons/css/buttons.bootstrap4.min.css') }}>

    <link rel="stylesheet" href={{asset('vendor/adminlte/dist/css/adminlte.min.css')}}>
    <title>Modulares Pendientes</title>
</head>
<body class="hold-transition sidebar-mini">

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">titulo de la tabla</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover display" style="overflow-x:auto;">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope="row"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td scope="row"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src={{asset('vendor/jquery/jquery.min.js')}}></script>
    <!-- Bootstrap 4 -->
    <script src={{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}></script>
    <!-- AdminLTE App -->
    <script src={{asset('vendor/adminlte/dist/js/adminlte.min.js')}}></script>

    <script src={{asset('vendor/bootstrap/datatables/jquery.dataTables.min.js')}}></script>
    <script src={{asset('vendor/bootstrap/datatables-bs4/js/dataTables.bootstrap4.min.js')}}></script>
    <script src={{asset('vendor/bootstrap/datatables-responsive/js/dataTables.responsive.min.js')}}></script>
    <script src={{asset('vendor/bootstrap/datatables-responsive/js/responsive.bootstrap4.min.js')}}></script>
    <script src={{asset('vendor/bootstrap/datatables-buttons/js/dataTables.buttons.min.js')}}></script>
    <script src={{asset('vendor/bootstrap/datatables-buttons/js/buttons.bootstrap4.min.js')}}></script>
    <script src={{asset('vendor/bootstrap/datatables-buttons/js/buttons.html5.min.js')}}></script>
    <script src={{asset('vendor/bootstrap/datatables-buttons/js/buttons.print.min.js')}}></script>
    <script src={{asset('vendor/bootstrap/datatables-buttons/js/buttons.colVis.min.js')}}></script>

</body>
</html>