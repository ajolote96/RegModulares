<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DateTime;
use DB;
use Auth;
use Yajra\DataTables\Facades\DataTables;


class empController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sshorasP()
    {
        $query = DB::table('horasprestadores');
        return DataTables::queryBuilder($query)
        ->editColumn('estado', function($query) {
            return view('columnTable.asistencia.radioButton')->with(["estado" => $query->estado, "id" => $query->id]);

        })
        ->editColumn('nota', function($query) {
            return view('columnTable.asistencia.btnnota')->with(["nota" => $query->nota, "id" => $query->id, "fechaQ"=>$query->fecha, "origen"=>$query->origen, "fecha"=>date("d/m/Y"), "hora_salida" => $query->hora_salida]);

        })
        ->editColumn('horas', function($query) {
            return view('columnTable.asistencia.selecthoras')->with(["horas" => $query->horas, "id" => $query->id, "origen"=>$query->origen]);

        })
        ->addColumn('eliminar', function($query) {
            return view('columnTable.asistencia.btneliminar')->with(["id" => $query->id, "codigo"=>$query->codigo, "origen"=>"horas" ]);

        })
        ->rawColumns(['estado','nota','eliminar'])
        ->make(true);
    }
    public function ssPrestadoresA()
    {
        $query = DB::table('soloprestadores');
        return DataTables::queryBuilder($query)
        ->addColumn('acciones', function($query) {
            return view('columnTable.prestadoresA.acciones')->with(["name" => $query->name, "id" => $query->id, 'tipo' => 'prestador',]);

        })
        ->rawColumns(['acciones'])
        ->make(true);
    }
    public function ssPrestadoresP()
    {
        $query = DB::table('prestadorespendientes');
        return DataTables::queryBuilder($query)
        ->addColumn('activacion', function($query) {
            return view('columnTable.prestadoresP.activacion')->with(["name" => $query->name, "id" => $query->id]);

        })
        ->rawColumns(['activacion'])
        ->make(true);
    }
    public function ssClientes()
    {
        $query = DB::table('soloclientes');
        return DataTables::queryBuilder($query)
        ->addColumn('acciones', function($query) {
            return view('columnTable.prestadoresA.acciones')->with(["name" => $query->name, "id" => $query->id, 'tipo' => 'clientes',]);

        })
        ->rawColumns(['acciones'])
        ->make(true);
    }
    public function ssAdministradores()
    {
        $query =DB::table('soloadmins');
        return DataTables::queryBuilder($query)
        ->addColumn('acciones', function($query) {
            return view('columnTable.prestadoresA.acciones')->with(["name" => $query->name, "id" => $query->id, 'tipo' => 'admin']);

        })
        ->rawColumns(['acciones'])
        ->make(true);
    }
    public function ssCitas()
    {

        $query = DB::table('cita_clientes');
        return DataTables::queryBuilder($query)
        ->addColumn('btn', function($query) {
            $query2 = DB::table('soloprestadores')->where('tipo','prestador')->get();
            $prestadoresa= $query2;

            if($query->status == "solicitud_aceptada"){
                $verificar = DB::table('impresionesasignados')->where("id_proyecto",$query->id_citas)->select("id_prestador")->get();
                $prestadores =  $verificar;

            }
            else{
                $prestadores = null;
            }
            return view('columnTable.citas.btncita')->with(["prestadoresa" => $prestadoresa, "id_citas" => $query->id_citas, "proyecto"=>$query->proyecto,"user"=>$query,"id"=>$query->id,  "prestadores"=>$prestadores]);
        })
        ->addColumn('link', function($query) {
            return view('columnTable.citas.link')->with([ "enlaceDrive" => $query->enlaceDrive]);
        })
        ->rawColumns(['btn','link','prestadores'])
        ->make(true);
    }

    public function ssFirmaspendientes()
    {
        $query =DB::table('horaspendientes');
        return DataTables::queryBuilder($query)
        ->editColumn('estado', function($query) {
            return view('columnTable.asistencia.radioButton')->with(["estado" => $query->estado, "id" => $query->id]);

        })
        ->editColumn('nota', function($query) {
            return view('columnTable.asistencia.btnnota')->with(["nota" => $query->nota, "id" => $query->id, "fechaQ"=>$query->fecha, "origen"=>$query->origen, "fecha"=>date("d/m/Y"), "hora_salida" => $query->hora_salida]);

        })
        ->editColumn('horas', function($query) {
            return view('columnTable.asistencia.selecthoras')->with(["horas" => $query->horas, "id" => $query->id, "origen"=>$query->origen]);

        })
        ->addColumn('eliminar', function($query) {
            return view('columnTable.asistencia.btneliminar')->with(["id" => $query->id, "codigo"=>$query->codigo, "origen"=>"horas" ]);

        })
        ->rawColumns(['estado','nota','eliminar'])
        ->make(true);
    }
    public function sstablaprestadores()
    {
        $id = Auth::user()->id;
        $query = DB::table('horasprestadores')->where('idusuario', $id);
        return DataTables::queryBuilder($query)
        ->editColumn('nota', function($query) {
            return view('columnTable.asistencia.btnnota')->with(["nota" => $query->nota, "id" => $query->id, "fechaQ"=>$query->fecha, "origen"=>$query->origen, "fecha"=>date("d/m/Y"), "hora_salida" => $query->hora_salida]);

        })
        ->rawColumns(['nota'])
        ->make(true);
    }
    public function sstablavisitas()
    {
        $query = DB::table('visitas');
        return DataTables::queryBuilder($query)
        ->editColumn('hora_salida', function($query){
            return view('columnTable.visitas.timepicker')->with(["hora_salida" => $query->hora_salida, "id"=> $query->id]);
        })
        ->editColumn('motivo', function($query) {
            return view('columnTable.asistencia.btnnota')->with(["nota" => $query->motivo, "id" => $query->id, "fechaQ"=>null, "origen"=>null, "fecha"=>null, "hora_salida"=>true]);

        })
        ->addColumn('eliminar', function($query) {
            return view('columnTable.asistencia.btneliminar')->with(["id" => $query->id, "codigo"=>$query->fecha." ".$query->name." ".$query->apellido,"origen"=>"visitas" ]);

        })
        ->rawColumns(['motivo'])
        ->make(true);
    }

    public function sstablaUserGeneral()
    {
        $query = DB::table('users')->select('id','name','apellido','tipo','tipo_cliente')->where('tipo','!=','Superadmin');
        return DataTables::queryBuilder($query)
        ->addColumn('acciones', function($query) {
            return view('columnTable.prestadoresA.acciones')->with(["name" => $query->name, "id" => $query->id, 'tipo' => 'admin']);

        })
        ->rawColumns(['acciones'])
        ->make(true);
    }


    public function ssPrestadoresProyectos()
    {
        $query = DB::table('impresiones_prestadores_pendientes');
        return DataTables::queryBuilder($query)
        ->addColumn('acciones', function($query) {
            return view('columnTable.citas.proyectos_prestadores_accion')->with(["id_impresion" => $query->id_proyecto, "id_impresion_prestador" => $query->id_impresion_prestador]);
        })->rawColumns(['acciones'])
        ->make(true);

    }

    public function ssProyectosPendientes()
    {
        $query =DB::table('modulares_pendientes');
        return DataTables::queryBuilder($query)
         ->addColumn('acciones', function($query) {
             return view('columnTable.actividades.acciones_actividades')->with(["info" => $query]);
         })
         ->rawColumns(['acciones'])
        ->make(true);
    }

    public function ssProyectosAprovados()
    {
        $query =DB::table('modulares_registrados');
        return DataTables::queryBuilder($query)
        // ->addColumn('acciones', function($query) {
        //     return view('columnTable.actividades.acciones_actividades')->with(["id_actividad" => $query->id_actividad, "actividad" =>$query, "nombre_act"=> $query->nombre_act]);

        //  })
         ->rawColumns(['acciones'])
        ->make(true);
    }



    public function ssProyectosCitados()
    {
        $query = DB::table('cita_clientes')->where('status','solicitud_aceptada');
        return DataTables::queryBuilder($query)
        // ->addColumn('acciones', function($query) {
        //     return view('columnTable.actividades.acciones_actividades')->with(["id_actividad" => $query->id_actividad, "actividad" =>$query, "nombre_act"=> $query->nombre_act]);

        //  })

        ->make(true);
    }
// --------------------------------------------------------------------------------------------------

// ZONA DE PRESTADORES


    public function ssImpresionesTerminadas()
    {

            $query = DB::table('prestadores_impresiones');

            //echo "<script> alert(JSON.stringify($query)); </script>";

            return DataTables::queryBuilder($query)->make(true);


    }
    public function ssActividadTerminada()
    {

            $query = DB::table('c_actividad')->where('status','=','Terminado');
            //echo "<script> alert(JSON.stringify($query)); </script>";

            return DataTables::queryBuilder($query)->make(true);


    }


}
