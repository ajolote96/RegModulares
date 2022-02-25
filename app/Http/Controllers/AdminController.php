<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\User;
use App\Models\Visitas;
use App\Models\premio;
use App\Models\cita_cliente;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Switch_;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\MailController;
use ProyectosPrestadores;
use \App\Exports\UserExport;



class AdminController extends Controller
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

    // public function index()
    // {
    //     $users =DB::table('horasprestadores')->orderBy('id','DESC')->get();;

    //     return view('/home',
    //         ['users'=>$users,
    //         'datos'=>['codigo','nombre','fecha','hora_entrada','hora_salida','tiempo'],
    //         'opcion'=> 'table',
    //         'nombre' => 'Tabla',
    //         'titulo'=>'Prestadores',
    //         'button'=>true,
    //         'accion'=>false,
    //         'cursos'=>false]);
    // }

    public function registro()
    {
        $carreras = DB::table('carreras')->get();
        return view('/home',['opcion'=> 'auth.registerAdmin','carreras' => $carreras, 'nombre' => 'Registro', 'ruta' => 'registrar']);
    }





    public function modificar(Request $request)
    {
        $id=$request->input('id');
        $tUser = Auth::user()->tipo;
        $uModificar = User::findOrFail($id);
        if(($tUser == "Superadmin") ||($tUser == "admin" && ($uModificar->tipo != "admin" && $uModificar->tipo != "checkin" && $uModificar->tipo != "Superadmin"))){
            $id=$request->input('id');
            $user = DB::table('users')->where('id',$id)->get();
            $carreras = DB::table('carreras')->get();
            return view('/home',['opcion'=> 'auth.registerAdmin','carreras' => $carreras, 'nombre' => 'Modificar', 'dV'=> $user, 'ruta' => 'admin.update']);

        }else{
            return redirect('/');
        }
    }

    //guardar estado

    public function guardar(Request $request)
    {
        print_r ("hola");
        $id=$request->input('id');
        $estado=$request->input('estado');
        $responsable=$request->input('responsable');
        $modificar = DB::table('horasprestadores')->where('id',$id)->update(['estado' => $estado, 'responsable'=> $responsable]);
    }

    //guardar horas

    public function guardar2(Request $request)
    {

        print_r ("hola");
        $id=$request->input('id');
        $horas=$request->input('horas');
        $responsable=$request->input('responsable');
        $modificar = DB::table('horasprestadores')->where('id',$id)->update(['horas' => $horas, 'responsable'=> $responsable]);
    }


    public function guardarstatus(Request $request)
    {

        print_r ("gurdarstatus");
        $id_citas=$request->input('id');
        $status=$request->input('status');
        $modificar = DB::table('cita_clientes')->where('id_citas',$id_citas)->update(['status' => $status]);
    }


    public function consultacursos1(Request $request)
    {

        print_r ("consulta1");
        $id=$request->input('id');
        $curso3=$request->input('curso3');
        $modificar = DB::table('clientes')->select('curso1')->where('id',$id)->get();
        print_r ($modificar);
        return (
            $modificar
        );

    }


    public function clientes()
    {
        $columns = array(["data"=>"id","visible"=>false],["data"=>"name"],["data"=>"codigo"],["data"=>"tipo_cliente"],["data"=>"created_at"],["data"=>"acciones","sortable"=> false]);

        return view(
            'home',
            ['datos'=>['id','Nombre','Codigo','Tipo de cliente','fecha de creacion', 'acciones'],//'fecha'],
            'opcion'=> 'table',
            'titulo' => 'Tabla Clientes',
            'ajaxroute'=>'ss.ssClientes',
            "columnas"=> json_encode($columns)]);
    }

    public function citas()
    {
        $columns = array(["data"=>"id","visible"=>false],["data"=>"fecha"],["data"=>"correo"],["data"=>"nombre"],["data"=>"proyecto"],["data"=>"status","sortable"=> false],["data"=>"btn","sortable"=> false],["data"=>"link","sortable"=> false]);

        $prestadores=DB::table('soloprestadores')->where('tipo','prestador')->get();


        return view(
            'home',
            ['datos'=>['id','fecha','correo','nombre','proyecto','status'],
            'opcion'=> 'table',
            'titulo' => 'Tabla de Impresiones',
            'ajaxroute'=>'ss.ssCitas',
            'prestadores'=>$prestadores,
            "columnas"=> json_encode($columns),
            'button'=>false,
            'accion'=>false,
            'enlace'=>true,
            'cursos'=>false,
            'descarga'=>false]);

    }

    public function registroVisitas()
    {
        return view(
            'home',
            [
            'fecha'=>date("d/m/Y"),
            'opcion'=> 'registroVisitas',
            'titulo' => 'Registro de Visitas',
            ]);

    }

    public function registrarVisitas(Request $request)
    {
        $insert = Visitas::create($request->all());
        return redirect('/')->with('success', 'Creado correctamente');
    }

    public function salidaVisita(Request $request)
    {
        $id=$request->input('id');
        $vmodificar = Visitas::findOrFail($id);
        $currentDateTime = date('H:i:s');
        $newDateTime = date('h:i A', strtotime($currentDateTime));
        $vmodificar->hora_salida = $newDateTime;
        $vmodificar->save();
        return redirect()->route('admin.visitas');


    }

    public function verCredencial(Request $request)
    {
        $descargasNombre=$request->input('descargaName');
        print_r ($descargasNombre);
        //ob_end_clean(); //esta cosa limpia el cache y hace que se descargue bien x)
        if(ob_get_contents()) ob_get_clean();
        $pathtoFile = public_path().'/img/credencial/'.$descargasNombre;
        return response()->download($pathtoFile);
    }

    public function verRender(Request $request)
    {
        $descargasNombre=$request->input('descargaName');
        print_r ($descargasNombre);
        //ob_end_clean(); //esta cosa limpia el cache y hace que se descargue bien x)
        if(ob_get_contents()) ob_get_clean();
        $pathtoFile = public_path().'/img/render/'.$descargasNombre;
        return response()->download($pathtoFile);
    }

    public function descargarArchivo(Request $request)
    {
        $descargasNombre=$request->input('descargaName');
        print_r ($descargasNombre);
        //ob_end_clean(); //esta cosa limpia el cache y hace que se descargue bien x)
        if(ob_get_contents()) ob_get_clean();
        $pathtoFile = public_path().'/img/archivo/'.$descargasNombre;
        return response()->download($pathtoFile);
    }

    public function prestadores()
    {

        $columns = array(["data"=>"id","visible"=>false],["data"=>"name"],["data"=>"codigo"],["data"=>"carrera"],["data"=>"horas"],["data"=>"horas_cumplidas"],["data"=>"horas_restantes"],["data"=>"acciones","sortable"=> false],);

        return view(
            'home',
            ['datos'=>['id','name','codigo','carrera','horas', 'horas_cumplidas','horas_restantes'],
            'opcion'=> 'table',
            'titulo' => 'Tabla Prestadores',
            'ajaxroute'=>'ss.ssPrestadoresA',
            "columnas"=> json_encode($columns),
            'button'=>false,
            'accion'=>true,
            'cursos'=>false,
            'descarga'=>false,]);
    }

    public function visitas()
    {

        $columns = array(["data"=>"id","visible"=>false],["data"=>"name"],["data"=>"apellido"],["data"=>"fecha"],["data"=>"hora_llegada","sortable"=> false],["data"=>"hora_salida","sortable"=> false],["data"=>"numero","sortable"=> false],["data"=>"motivo","sortable"=> false],["data"=>"responsable"],["data"=>"eliminar","sortable"=> false]);

        return view(
            'home',
            ['datos'=>['id','name','apellido','fecha','hora_llegada', 'hora_salida','numero','motivo','responsable'],
            'opcion'=> 'table',
            'titulo' => 'Tabla Visitas',
            'ajaxroute'=>'ss.sstablavisitas',
            "columnas"=> json_encode($columns),
            'button'=>false,
            'accion'=>true,
            'cursos'=>false,
            'descarga'=>false,]);
    }

    public function administradores()
    {
        $columns = array(["data"=>"id","visible"=>false],["data"=>"name"],["data"=>"apellido"],["data"=>"correo"],["data"=>"acciones","sortable"=> false],);

        return view(
            'home',
            ['datos'=>['id','name','apellido','correo'],
            'tipo' => 'admin',
            'opcion'=> 'table',
            'titulo' => 'Tabla Administradores',
            'ajaxroute'=>'ss.ssAdministradores',
            "columnas"=> json_encode($columns),
            'button'=>false,
            'accion'=>true,
            'cursos'=>false,
            'descarga'=>false,]);
    }
    public function general()
    {
        $columns = array(["data"=>"id"],["data"=>"name"],["data"=>"apellido"],["data"=>"tipo"],["data"=>"tipo_cliente"],["data"=>"acciones","sortable"=> false]);

        return view(
            'home',
            ['datos'=>['id','name','apellido','tipo','tipo_cliente'],
            'tipo' => 'general',
            'opcion'=> 'table',
            'titulo' => 'Tabla General',
            'ajaxroute'=>'ss.sstablausuarios',
            "columnas"=> json_encode($columns),
            'button'=>false,
            'accion'=>true,
            'cursos'=>false,
            'descarga'=>false,]);
    }

    public function premios()
    {
        $users =DB::table('premios')->orderBy('id','DESC')->get();

        return view(
            'home',
            ['users'=>$users, 'datos'=>['nombre','descripcion','tipo','horas'],
            'tipo' => 'admin',
            'opcion'=> 'table',
            'titulo' => 'Tabla Administradores',
            'button'=>false,
            'accion'=>true,
            'cursos'=>false,
            'descarga'=>false,]);
    }

    public function prestadoresPendientes()
    {
        $columns = array(["data"=>"id"],["data"=>"name"],["data"=>"codigo"],["data"=>"tipo"],["data"=>"created_at"],["data"=>"activacion","sortable"=> false]);

        return view(
            'home',
            ['datos'=>['id','name','codigo','tipo','created_at'],
            'tipo' => 'prestador',
            'opcion'=> 'table',
            'titulo' => 'Tabla Prestadores',
            'ajaxroute'=>'ss.ssPrestadoresP',
            "columnas"=> json_encode($columns),
            'button'=>false,
            'accion'=>false,
            'cursos'=>false,
            'descarga'=>false,
            'activacion'=>true,]);
    }



    public function firmasPendientes()
    {
        $columns = array(["data"=>"id","visible"=>false],["data"=>"codigo"],["data"=>"nombre"],["data"=>"apellido"],["data"=>"fecha"],["data"=>"hora_entrada","sortable"=> false],["data"=>"hora_salida","sortable"=> false],["data"=>"tiempo","sortable"=> false],["data"=>"estado"],["data"=>"horas"],["data"=>"responsable"],["data"=>"nota","sortable"=> false],["data"=>"eliminar","sortable"=> false]);

        return view(
            '/home',
            ['datos'=>['id','codigo','nombre','apellido','fecha','hora_entrada','hora_salida','tiempo'],
            'opcion'=> 'table',
            'titulo' => 'Registro de asistencia',
            'ajaxroute'=>'ss.ssFirmaspendientes',
            "columnas"=> json_encode($columns),
            'button'=>true,
            'accion'=>false,
            'cursos'=>false,
            'btneliminar'=>true,
            'fecha'=>date("d/m/Y"),
            'modal'=>true,
            'descarga'=>false,]);
    }




    public function recompensas()
    {
        return view(
            '/home',
            [
            'opcion'=> 'registro_recompensas']
            );
    }

    public function C_Actividades()
    {
        $prestadores=DB::table('soloprestadores')->where('tipo','prestador')->get();
        return view(
            '/home',
            [
            'prestadores'=>$prestadores,
            'opcion'=> 'C_Actividades']
            );
    }
    public function actividad_asignada(Request $request){
        $nomact = $request->input('nombre');
        $tipo = $request->input('tipo_actividad');
        $prestadores = $request->input('prestador');
        $desc = $request->input('descripcion');
        $obj = $request->input('objetivo');
        $fecha = $request->input('datepiker');
        $insertar = DB::table('c_actividad')->insert(['nombre_act'=>$nomact, 'tipo_act'=>$tipo, 'id_prestador'=>$prestadores, 'descripcion'=>$desc, 'objetivo'=>$obj, 'fecha'=>$fecha]);
        return redirect('/')->with('success', 'Creado correctamente');
    }





    public function adminUpdate(Request $request)
    {
        $id=$request->input('id');
        $validation = $this->validator($request->all(),$id);
        if($validation->fails()){
            return redirect('/admin/modificar?id='.$id)->withInput()->withErrors($validation->errors());
        }
        else{
            $input = $request->all();
            $usuario = User::findOrFail($id);
            $usuario->fill($input)->save();
            if($usuario->tipo == "clientes" && !DB::table('clientes')->where('id',$id)->exists()){

                $crear = DB::table('clientes')->insert(
                    ['id' => $id,
                    'codigo'=>$usuario->codigo,
                    'nombre'=>$usuario->name,
                    ]
                );
            }
            if(DB::table('clientes')->where('id',$id)->exists()){
                $crear = DB::table('clientes')->where('id',$id)->update(
                    ['id' => $id,
                    'codigo'=>$usuario->codigo,
                    'nombre'=>$usuario->name,
                    ]
                );
            }
            return redirect()->route($this->rutaRegreso($request->input('TipoOriginal')))->with('success', 'Modificado correctamente');
        }
    }

    public function activar(Request $request)
    {
        try {
            $id=$request->input('id');
            $modificar = DB::table('users')->where('id',$id)->update(['tipo' =>"prestador"]);

            return redirect()->route($this->rutaRegreso("prestadoresPendientes"))->with('success', 'Activado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route($this->rutaRegreso('prestadoresPendientes'))->with('error', $th->getMessage());
        }

    }

    public function cita_programar(Request $request)
    {

        try {
            $id_citas=intval($request->input('id_citas'));
            $id=$request->input('duallistbox_demo1');
            $fecha=$request->input('fechacita');
            if($request->input('status') != "solicitud_aceptada"){
                $modificar = cita_cliente::where("id_citas","=",$id_citas)->firstOrFail();
                if($modificar){
                    $modificar = DB::table('cita_clientes')->where('id_citas',$id_citas)->update(['status' =>"solicitud_aceptada", 'fechacita'=> $fecha]);
                }
                foreach($id as $item)
                {
                    $insertar = DB::table('proyectos_prestadores')->insert(['id_proyecto'=>$id_citas, 'id_prestador'=>$item]);
                }

            }else{
                $modificar = DB::table('cita_clientes')->where('id_citas',$id_citas)->update(['status' =>"solicitud_aceptada", 'fechacita'=> $fecha]);

                $eliminar = DB::table('proyectos_prestadores')->where('id_proyecto',"=",$id_citas)->delete();

                foreach($id as $item)
                 {
                     $insertar = DB::table('proyectos_prestadores')->insert(['id_proyecto'=>$id_citas, 'id_prestador'=>$item]);
                 }

            }




            $email = $request->input('correo');

            $mailData = [

                'receptor' => $email,
                'asunto' => 'Solicitud exitosa!',
                'id_citas' => $request->input('id_citas'),
                'proyecto' => $request->input('proyecto'),
                'despedida' => 'no pus espere jaja lol',
                'vista' => 'email.impresionMail',
                'nombre'=>$request->input('nombre'),
                'title' => 'Solicitud Aceptada',
                'body' => 'Tu solicitud a sido aceptada, por favor agenda tu cita en el menu principal.'
            ];

             $correo = new MailController($mailData);
             $correo->sendEmail();


            return redirect()->route($this->rutaRegreso("proyecto"))->with('success', 'Aceptado correctamente');
        } catch (\Throwable $th) {
           return redirect()->route($this->rutaRegreso('proyecto'))->with('error', $th->getMessage());
        }

    }

    public function destroy(Request $request)
    {
        try {
            $id=$request->input('id');
            $opcion=$request->input('opcion');
            switch($opcion){
                case 'usuario':
                    $eliminar = DB::table('users')->where('id',$id)->delete();
                    if(DB::table('clientes')->where('id',$id)->exists()){
                        $eliminar2 = DB::table('clientes')->where('id',$id)->delete();
                    }
                    break;
                case 'horas':
                    if(DB::table('horasprestadores')->where('id',$id)->exists()){
                        $eliminar2 = DB::table('horasprestadores')->where('id',$id)->delete();
                    }
                    break;
                case 'proyecto':
                    if(DB::table('cita_clientes')->where('id_citas',$id)->exists()){
                        // $proyecto = DB::table('cita_clientes')->where('id_citas',$id)->get();
                        // File::delete(public_path().'/img/credencial/'.$proyecto[0]->credencial,public_path().'/img/archivo/'. $proyecto[0]->ArchivoSTL,public_path().'/img/render/'. $proyecto[0]->render);
                        $eliminar2 = DB::table('cita_clientes')->where('id_citas',$id)->delete();
                        $eliminar3 = DB::table('proyectos_prestadores')->where('id_proyecto',"=",$id)->delete();
                    }
                    break;
                    case 'actividades':
                        if(DB::table('c_actividad')->where('id_actividad',$id)->exists()){
                            $eliminar2 = DB::table('c_actividad')->where('id_actividad',$id)->delete();
                        }
                        break;
                case 'visitas':
                    if(DB::table('visitas')->where('id',$id)->exists()){
                        $eliminar2 = DB::table('visitas')->where('id',$id)->delete();
                    }
                    break;

            }

            return redirect()->route($this->rutaRegreso($request->input('TipoOriginal')))->with('success', 'Eliminado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route($this->rutaRegreso($request->input('TipoOriginal')))->with('error', $th->getMessage());
        }

    }

    public function checkin(){
        return view('home',['opcion'=> 'auth.checkin', 'nombre' => 'Check-In', 'ruta' => 'registrar']);
    }

    public function rutaRegreso($tipoOriginal){
        switch($tipoOriginal){
            case 'prestador':
                return 'admin.prestadores';
                break;
            case 'clientes':
                return 'admin.clientes';
                break;
            case 'proyecto':
                return 'admin.citas';
                break;
            case 'visitas':
                return 'admin.visitas';
                break;
            case 'admin':
                return 'admin.administradores';
                break;
            case 'general':
                return 'admin.general';
                break;
            default:
                return 'admin.home';
                break;
        }
    }

    public function validator(array $data, $id)
    {

        switch($data['tipo']){
            case 'prestador':
                $rHoras =  ['required'];
                $rCarrera = ['required','string'];
                $rCodigo = ['required','string','unique:users,codigo,'.$id];

                break;
            case 'clientes':
                switch($data['tipo_cliente']){
                    case 'Alumno':
                    case 'Maestro':
                        $rHoras =  ['nullable'];
                        $rCarrera = ['required','string'];
                        $rCodigo = ['required','string','unique:users,codigo,'.$id];
                        break;
                    case 'Otro':
                        $rHoras =  ['nullable'];
                        $rCarrera = ['nullable'];
                        $rCodigo = ['nullable'];
                }
                break;
            case 'admin':
                $rHoras =  ['nullable'];
                $rCarrera = ['nullable'];
                $rCodigo = ['nullable'];
                break;

        }
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'codigo' => $rCodigo,
            'tipo' => ['required', 'string'],
            'correo' => ['required', 'email', 'unique:users,correo,'.$id],
            'horas' => $rHoras,
            'carrera' => $rCarrera,


        ]);
    }



    public function validator_premios(array $data)
    {



        switch($data['tipo']){
            case 'horas':
                $rHoras =  ['required'];

                break;
            case 'otro':
                $rHoras =  ['nullable'];
                break;


        }
        return Validator::make($data, [

            'nombre' =>['required', 'string','max:100'],
            'descripcion' => ['required', 'string','max:255'],
            'tipo' => ['required'],
            'horas' => $rHoras,


        ]);
    }


    protected function create_premios(Request $request)
    {


        $validation = $this->validator_premios($request->all());

        if($validation->fails()){
            var_dump($validation->errors());
            return redirect('/admin/recompensasRegistro')->withInput()->withErrors($validation->errors());
        }

        switch($request['tipo']){
            case 'horas':

                $horas = $request['horas'];

                break;
            case 'otro':
                $horas = null;
                break;
        }
        return premio::create([

            'nombre'=>$request['nombre'],
            'descripcion'=>$request['descripcion'],
            'tipo'=>$request['tipo'],
            'horas'=>$horas
        ]);
    }



    public function prestadoresProyectos()
    {
        $columns = array(
            ["data"=>"id_prestador","visible"=>false],
            ["data"=>"nombre_prestador"],
            ["data"=>"apellido_prestador"],
            ["data"=>"Nombre_Proyecto"],
            ["data"=>"acciones"]

        );

        return view(
            'home',
            ['datos'=>[
                "id",
                "Nombre del prestador",
                "Apellido",
                "Nombre del Proyecto",
                "Acciones"
             ],
            'opcion'=> 'table',
            'titulo' => 'Tabla Proyectos-Prestadores',
            'ajaxroute'=>'ss.ssPrestadoresProyectos',
            "columnas"=> json_encode($columns),
            'button'=>false,
            'accion'=>false,
            'cursos'=>false,
            'descarga'=>false,]);

    }

    public function ProyectosCitados()
    {
        $columns = array(
            ["data"=>"id","visible"=>false],
            ["data"=>"proyecto"],
            ["data"=>"nombre"],
            ["data"=>"telefono"],
            ["data"=>"carrera"],
            ["data"=>"fechacita"],



        );

        return view(
            'home',
            ['datos'=>[
                "id",
                "Nombre del Proyecto",
                "Cliente",
                "telefono",
                "Carrera",
                "Cita",
                "Acciones",

             ],
            'opcion'=> 'table',
            'titulo' => 'xd ',
            'ajaxroute'=>'ss.ssProyectosCitados',
            "columnas"=> json_encode($columns),
            'button'=>false,
            'accion'=>false,
            'cursos'=>false,
            'descarga'=>false,]);

    }


    //solicitud_aceptada




    public function impresion_terminada(Request $request){

        $id_impresion =   $request->id_impresion;
        $id_impresion_prestador =  $request->id_impresion_prestador;

        $modificar = DB::table('proyectos_prestadores')->where('id',$id_impresion_prestador)->update(
            ['status' => 'terminado']
        );

        return redirect()->route("admin.prestadoresProyectos");
    }


    // public function visitas()
    // {

    //     $columns = array(["data"=>"id","visible"=>false],["data"=>"name"],["data"=>"apellido"],["data"=>"fecha"],["data"=>"hora_llegada","sortable"=> false],["data"=>"hora_salida","sortable"=> false],["data"=>"numero","sortable"=> false],["data"=>"motivo","sortable"=> false],["data"=>"responsable"],["data"=>"eliminar","sortable"=> false]);

    //     return view(
    //         'home',
    //         ['datos'=>['id','name','apellido','fecha','hora_llegada', 'hora_salida','numero','motivo','responsable'],
    //         'opcion'=> 'table',
    //         'titulo' => 'Tabla Visitas',
    //         'ajaxroute'=>'ss.sstablavisitas',
    //         "columnas"=> json_encode($columns),
    //         'button'=>false,
    //         'accion'=>true,
    //         'cursos'=>false,
    //         'descarga'=>false,]);
    // }



    public function prestadores_asignados(Request $request)
    {
        //$id=$request->input('id');
        //error_log('message here.');
        //var_dump($request->ids);

        foreach($request->ids as $item)
            {
                $insertar = DB::table('proyectos_prestadores')->insert([ 'id_prestador'=>$item, 'id_proyecto'=>$request->id_proyecto]);

            }

    }

    public function home()
    {

        $statusSistema = DB::table('status')->where('id','1')->get();


        $columns = array(["data"=>"id_modular"],
                            ["data"=>"Titulo"],
                            ["data"=>"nombre_alumno"],
                            ["data"=>"apellido"],
                            ["data"=>"correo"],
                            ["data"=>"codigo"],
                            ["data"=>"acciones"],



                        );
        return view(
            'home',
            ['datos'=>[
                'Id',
                'Proyecto Modular',
                'Nombre del Representante',
                'Apellido(s)',
                'Correo',
                'Codigo de estudiante',
                'Acciones'

            ],
            'opcion'=>'table',
            'titulo'=>'Tabla de Proyectos Pendientes',
            'ajaxroute'=>'ss.ssProyectosPendientes',
            "columnas" => json_encode($columns),
            'statusSistema' => $statusSistema,
            'button'=>false,
            'accion'=>false,
            'cursos'=>false,
            'descarga'=>false,]);

    }


    public function ProyectosPendientes(){

        $statusSistema = DB::table('status')->where('id','1')->get();


        $columns = array(["data"=>"id_modular"],
                            ["data"=>"Titulo"],
                            ["data"=>"nombre_alumno"],
                            ["data"=>"apellido"],
                            ["data"=>"correo"],
                            ["data"=>"codigo"],
                            ["data"=>"acciones"],



                        );
        return view(
            'home',
            ['datos'=>[
                'Id',
                'Proyecto Modular',
                'Nombre del Representante',
                'Apellido(s)',
                'Correo',
                'Codigo de estudiante',
                'Acciones'

            ],
            'opcion'=>'table',
            'titulo'=>'Tabla de Proyectos Pendientes',
            'ajaxroute'=>'ss.ssProyectosPendientes',
            "columnas" => json_encode($columns),
            'statusSistema' => $statusSistema,
            'button'=>false,
            'accion'=>false,
            'cursos'=>false,
            'descarga'=>false,]);
    }


    public function ProyectosAprovados(){

        $statusSistema = DB::table('status')->where('id','1')->get();

        $columns = array(["data"=>"id_modular"],
        ["data"=>"Titulo"],
        ["data"=>"nombre_alumno"],
        ["data"=>"apellido"],
        ["data"=>"correo"],
        ["data"=>"codigo"],


        );

        return view(
            'home',
            ['datos'=>[
            'Id',
            'Proyecto Modular',
            'Nombre del Representante',
            'Apellido(s)',
            'Correo',
            'Codigo de estudiante',
            'Acciones'
        ],
        'opcion'=>'table',
        'titulo'=>'Tabla de Proyectos Aprobados',
        'ajaxroute'=>'ss.ssProyectosAprovados',
        "columnas" => json_encode($columns),
        'statusSistema' => $statusSistema,
        'button'=>false,
        'accion'=>false,
        'cursos'=>false,
        'descarga'=>false,]);
    }

    public function AprobarProyecto(Request $request){

        $id = $request->id_alumno;
        $id_modular = $request->id_modular;


        $modificar = DB::table('users')->where('id',$id)->update(
            ['status' => 'registrado']
        );
        $email = $request->input('correo');

            $mailData = [
                     'receptor' => $email,
                     'asunto' => 'Solicitud exitosa!',
                     'nombre'=>$request->input('nombre_alumno'),
                     'title' => 'Solicitud enviada',
                     'id_citas' =>$request->input('id_modular'),
                     'proyecto' =>$request->input('id_modular'),
                     'body' => 'Tu solicitud va a ser procesada, estate a pendiente a tu usuario y/o correo',
                     'despedida' => 'XD',
                     'vista' => 'email.impresionMail'
                 ];

                 $correo = new MailController($mailData);
                 $correo->sendEmail();

        $modificar = DB::table('modulares')->where('id',$id_modular)->update(
            ['status' => 'registrado']
        );

        return redirect()->route("admin.ProyectosPendientes");
    }


    public function RechazarProyecto(Request $request){

        $id = $request->id_alumno;
        $id_modular = $request->id_modular;

        //$modificar = DB::table('modulares')->where('id',$id_modular)->delete();

        $modificar = DB::table('users')->where('id',$id)->update(
            ['status' => 'denegado']
        );

        return redirect()->route("admin.ProyectosPendientes");
    }


    public function PDFProyecto(Request $request){






        //$pdf = \PDF::loadView('ejemplo');
    }


    public function viewProyecto(Request $request){

        $id_usuario = $request->id_usuario;

        $modular = DB::table('pdf')
        ->where('id_alumno',$id_usuario)
        ->get();

       // var_dump($modular);

        //return view('PDF',['info'=>$modular]);
        $pdf = \PDF::loadView('PDF',['info'=>$modular]);
        return $pdf->download('Registro_Modular.pdf');


        //$pdf = \PDF::loadView('ejemplo');
    }

    public function Excel(){

        $query =DB::table('modulares_pendientes')->get();
        return \Excel::download(new UserExport,'TablaProyectosModulares.xlsx');
    }


    public function activarregistros()
    {

        $statusSistema = DB::table('status')->where('id','1')->get();

        //  echo "<script> alert(JSON.stringify($statusSistema)); </script>";
        if( $statusSistema[0]->status == '1' ){

            $modificar = DB::table('status')->where('id','1')->update([

                'status'=>"0"
            ]);
        }
        else{
            $modificar = DB::table('status')->where('id','1')->update([

                'status'=>"1"
            ]);
        }



        return redirect()->route("admin.ProyectosPendientes");

    }


}
