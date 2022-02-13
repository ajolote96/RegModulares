<?php

namespace App\Http\Controllers;

use App\Models\cita_cliente;
use App\Models\User;
use App\Models\modulare;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use App\Rules\MaxWordsRule;
use App\Http\Controllers\MailController;

class VisitanteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function principal()
    {

        $codigo = Auth::user()->id;
        $users = DB::table('clientes')->where('id',$codigo)->get();
        $cita = DB::table('cita_clientes')->where('id',$codigo)->get();

        return view('/homeV',['opcion'=>'principal_clientes', 'users'=>$users, 'cita'=>$cita, 'datos'=>['curso1', 'curso2', 'curso3'], 'datos2'=>['proyecto', 'fecha', 'status']]);
    }


    public function visita()
    {
        return view('/homeV',['opcion'=>'visitas']);

    }

    public function guardarCita(Request $request)
    {

        echo "<script> alert(JSON.stringify($request)); </script>";

        $validator = Validator::make($request->all(),[

             'Titulo'=>'required',
             'Area_participacion'=>'required',

             'asesor_nombre_1'=> 'required',
             'asesor_codigo_1'=> 'required|max:12|min:5',
             'asesor_departamento_1'=> 'required',
             'asesor_correo_1'=> 'required',

             'actividad_integrantes'=> 'required',
             'resumen'=> 'required',

             'justificacion_m1' =>'required',
             'justificacion_m2' =>'required',
             'justificacion_m3' =>'required',

        ]);

        if($validator ->fails()){
            return redirect()->route('cliente.registro')->withInput()->withErrors($validator->errors());
        }else{
            $datos = $request->all();

            $insert = modulare::create($datos);

            $usuario =User::find($request->id_usuario);
            $usuario->status = 'pendiente';
            $usuario->save();




                return redirect()->route('cliente.home');
        }


    }


    public function ActualizarCita(Request $request)
    {

        echo "<script> alert(JSON.stringify($request)); </script>";

        $validator = Validator::make($request->all(),[

             'Titulo'=>'required',
             'Area_participacion'=>'required',

             'asesor_nombre_1'=> 'required',
             'asesor_codigo_1'=> 'required|max:12|min:5',
             'asesor_departamento_1'=> 'required',
             'asesor_correo_1'=> 'required',

             'actividad_integrantes'=> 'required',
             'resumen'=> 'required',

             'justificacion_m1' =>'required',
             'justificacion_m2' =>'required',
             'justificacion_m3' =>'required',

        ]);

        if($validator ->fails()){
            return redirect()->route('cliente.registro')->withInput()->withErrors($validator->errors());
        }else{
            $datos = $request->all();

            $modular =modulare::find($request->id_modular);
            $modular->update([
                'Titulo' =>$request->Titulo,
                'Area_participacion' => $request->Area_participacion ,
                'Codigo_1' => $request->Codigo_1 ,
                'Nombre_1'  => $request->Nombre_1,
                'Correo_1'  => $request->Correo_1,
                'Carrera_1'  => $request->Carrera_1,
                'Codigo_2' =>  $request->Codigo_2,
                'Nombre_2'  => $request->Nombre_2,
                'Correo_2'  => $request->Correo_2,
                'Carrera_2'  => $request->Carrera_2,
                'asesor_codigo_1'  => $request->asesor_codigo_1,
                'asesor_nombre_1'  => $request->asesor_nombre_1,
                'asesor_departamento_1'  => $request->asesor_departamento_1,
                'asesor_correo_2'  => $request->asesor_correo_2,
                'asesor_codigo_2'  => $request->asesor_codigo_2,
                'asesor_nombre_2'  => $request->asesor_nombre_2,
                'asesor_departamento_2'  => $request->asesor_departamento_2,
                'asesor_correo_2'  => $request->asesor_correo_2,
                'resumen'  => $request->resumen,
                'justificacion_m1'  => $request->justificacion_m1 ,
                'justificacion_m2'  => $request->justificacion_m2,
                'justificacion_m3'  => $request->justificacion_m3,
                'actividad_integrantes'  => $request->actividad_integrantes,
                'status' => 'pendiente'
                ]);

            $modular->save();


            $usuario =User::find($request->id_usuario);
            $usuario->update([
                'name'  => $request->r_nombre,
                'apellido'  => $request->r_apellido,
                'codigo '  => $request->r_codigo,
                'status'  => 'pendiente'
            ]);

            $usuario->save();




                return redirect()->route('cliente.home');
        }


    }


    public function guardarVisita(Request $request)
    {

            $id=$request->input('id');
            $curso=$request->input('Curso');
            $fecha=$request->input('fecha');
            $nombre=$request->input('name');


            $modificar = DB::table('clientes')->where('id',$id)->update([


                'nombre'=>$nombre,
                'fecha'=>$fecha,
                $curso=>'citado'

                ]);

                return redirect()->route('cliente.home');

    }

    public function registro()
    {

        $status = Auth::user()->status;

        if( $status == 'sin_registro' )
        {

            return view('/homeV',['opcion'=>'registro_clientes']);
        }
        else
        {
            return $this->principal();
        }


    }

    public function registro_modificar()
    {
        $status = Auth::user()->status;
        $id_usuario = Auth::user()->id;

        $modular = DB::table('pdf')
        ->where('id_alumno',$id_usuario)
        ->get();


        if($status == 'denegado' || $status == 'pendiente' )
        {

            return view('/homeV',['opcion'=>'modificar_clientes','info'=>$modular]);
        }
        else
        {
            return $this->principal();
        }


    }

    public function confirmar_cita(Request $request)
    {
        $id=$request->input('id_cita');
        $fecha=$request->input('fecha_cita');
        $modificar = DB::table('cita_clientes')->where('id_citas',$id)->update([
            'fechacita'=>$fecha,
            'status'=>"cita_programada"
        ]);

        return redirect()->route('cliente.home');

    }
}
