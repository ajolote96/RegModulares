<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use DateTime;
use PhpParser\Node\Expr\AssignOp\Concat;
use PhpParser\Node\Stmt\TryCatch;

class PrestadorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function horas()
    {
        $columns = array(["data"=>"id","visible"=>false],["data"=>"fecha"],["data"=>"hora_entrada","sortable"=> false],["data"=>"hora_salida","sortable"=> false],["data"=>"tiempo"],["data"=>"horas"],["data"=>"estado","sortable"=> false],["data"=>"nota","sortable"=> false]);
        $id = Auth::user()->id;
        $horas = DB::table('horasprestadores')->where('idusuario', $id)->where('estado', 'autorizado')->sum('horas');
        $horasT = DB::table('users')->where('id', $id)->select('horas')->get();

        return view(
            '/homeP',
            ['datos'=>['id','fecha','hora_entrada','hora_salida','tiempo','horas','estado'],
            'titulo'=>'Registro de horas',
            'button'=>false,
            'accion'=>false,
            'fecha'=>date("d/m/Y"),
            'ajaxroute'=>'ss.sstablaprestadores',
            "columnas"=> json_encode($columns),
            'cursos'=>false,
            'horas'=>$horas,
            'horasT'=> $horasT[0]->horas - $horas,
            'modal'=>true,
            'descarga'=>false]);
    }


    public function marcar(Request $request)
    {

        try {
            $dir = '';
            switch (Auth::user()->tipo) {
                case 'admin':
                    $dir = 'admin.checkin';
                    break;
                case 'Superadmin':
                    $dir = 'admin.checkin';
                    break;

                case 'checkin':
                    $dir = 'api.checkin';
                    break;
            };
            $codigo= $request->input('codigo');
            $usuario = DB::table('users')->where('codigo',$codigo)->where('tipo','prestador')->select('name','id','apellido')->get();
            $verificar = DB::table('horasprestadores')->where('idusuario',$usuario[0]->id)->where('fecha',date("d/m/Y"))->where('hora_salida', null)->exists();
            if($verificar){
                $hor = date('H:i:s');
                $tiempo = DB::table('horasprestadores')->select('hora_entrada')->where('idusuario',$usuario[0]->id)->where('fecha',date("d/m/Y"))->where('hora_salida', null)->get();
                $tiempoCompleto = $this->diferencia($tiempo[0]->hora_entrada,$hor);
                $salida = DB::table('horasprestadores')->where('idusuario',$usuario[0]->id)->where('fecha',date("d/m/Y"))->where('hora_salida', null)->update(['hora_salida' => $hor, 'tiempo'=>$tiempoCompleto,'horas'=> $this->horasC($tiempoCompleto)] );
                return redirect()->route($dir)->with('success', 'Adios '.$usuario[0]->name);
            }else{
                $inicio = DB::table('horasprestadores')->insert([['origen'=>'checkin','idusuario'=>$usuario[0]->id,'codigo'=>$codigo,'nombre'=>$usuario[0]->name,'apellido'=>$usuario[0]->apellido  ,'fecha'=>date("d/m/Y"),'hora_entrada'=>date('H:i:s'),'horas'=>0]]);
                return redirect()->route($dir)->with('success', 'Bienvenido '.$usuario[0]->name. '!');
            }

        } catch (\Throwable $th) {

            return redirect()->route($dir)->with('error', $th->getMessage());

        }

    }
    public function asirgarfirmas(Request $request){
        $id = $request->input('id');
        $horas = $request->input('horas');
        $nota = $request->input('nota');
        $usuario = DB::table('users')->where('id',$id)->where('tipo','prestador')->select('name','id','apellido','codigo')->get();
        $inicio = DB::table('horasprestadores')->insert([['origen'=> 'Superadmin','idusuario'=>$usuario[0]->id,'codigo'=>$usuario[0]->codigo,'nombre'=>$usuario[0]->name,'apellido'=>$usuario[0]->apellido  ,'fecha'=>date("d/m/Y"),'hora_entrada'=>'no aplica', 'hora_salida' => 'no aplica', 'horas'=>$horas, 'nota'=>$nota, 'tiempo'=>'no aplica', 'estado'=>'autorizado', 'responsable'=> $request->input('responsable')]]);
        return redirect()->route('admin.prestadores');
    }

    public function guardarNota(Request $request)
    {
        $id=$request->input('id');
        $nota=$request->input('nota');
        $modificar = DB::table('horasprestadores')->where('id',$id)->update(['nota' => $nota]);
        return redirect('/admin/firmas');
    }

    function diferencia($hora,$hora2){
        $time1 = new DateTime($hora);
        $time2 = new DateTime($hora2);
        $interval = $time1->diff($time2);
        return $interval->format('%H:%I:%S');
    }

    function horasC($time){
        $horas = new DateTime($time);
        $tiempo = $horas->format('H.i');
        if(fmod($tiempo,1) > 0.30){
            $tiempo = $tiempo + 1;
        }
        return intval($tiempo);
    }

     public function proyectos(){
        $id = Auth::user()->id;
        $actividad_prestador = DB::table('c_actividad')->where('id_prestador', $id)->where('status', 'en proceso')->get();
        $Impresiones_prestador = DB::table('impresionesasignados')->where('id_prestador', $id)->where('status_impresion', 'en proceso')->get();

        return view(
            '/proyectostabla',
            [
            'actividades'=> $actividad_prestador,
            'impresiones'=> $Impresiones_prestador,
            ]
        );
     }

     public function proyectos_prendientes(){
        $id = Auth::user()->id;
        $actividad_prestador = DB::table('c_actividad')->where('id_prestador', $id)->get();
        $Impresiones_prestador = DB::table('impresionesasignados')->where('id_prestador', $id)->where('status_impresion', 'en proceso')->get();

        return view(
            '/proyectospendientes',
            [
            'actividades'=> $actividad_prestador,
            'impresiones'=> $Impresiones_prestador,
            ]
        );
     }


    public function completar_impresion(Request $request)
    {
        $id=$request->input('id');

        $modificar = DB::table('proyectos_prestadores')->where('id_proyecto',$id)->update(['status' => "completado"]);
        return redirect('/proyectostabla');
    }

    public function prestadoresProyectosCompletados()
    {
        $columns = array(["data"=>"id_prestador"],["data"=>"nombre_prestador"]);
        $id = Auth::user()->id;
        //$hola = ss.ssImpresionesTerminadas();

         var_dump(route('ss.ssImpresionesTerminadas'));

        //  echo "<script> alert(JSON.stringify($id)); </script>";


        return view(
            '/proyectospendientes',
            ['datos'=>["id","nombre"],
            'titulo' => 'Tabla Proyectos-Prestadores',
            'ajaxroute'=>'ss.ssImpresionesTerminadas',
            "columnas"=> json_encode($columns),
            ]);
    }

    public function completar_actividad(Request $request)
    {
        $id=$request->input('id');
        echo "<script> alert(JSON.stringify($id)); </script>";
        $modificar = DB::table('c_actividad')->where('id_actividad',$id)->update(['status' => "completado"]);
        
        
        return redirect('/proyectospendientes');
    }

    public function Pactividadterminada()
    {
        $columns = array(["data"=>"id_actividad","visible"=>false],
                            ["data"=>"nombre_act"],
                            ["data"=>"tipo_act"],
                            ["data"=>"id_prestador"],
                            ["data"=>"descripcion","visible"=>false,"sortable"=> false],
                            ["data"=>"objetivo","visible"=>false,"sortable"=> false],
                            ["data"=>"fecha"],
                            ["data"=>"status"],
                        );
        $id = Auth::user()->id;

        return view(
            '/P_actividades',
            ['datos'=>['id_actividad','nombre','tipo de actividades','id prestador', 'descripcion', 'objetivo','fecha', 'status'],
            'titulo' => 'Tabla Actividades-Prestadores',
            'ajaxroute'=>'ss.ssActividadTerminada',
            "columnas"=> json_encode($columns),
            ]);
    }


}
