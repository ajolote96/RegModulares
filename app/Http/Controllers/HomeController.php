<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function register()
    {
        $carreras = DB::table('carreras')->get();
        return view('auth.register',['ruta' => 'registrar', 'nombre'=> 'registro', 'carreras' => $carreras]);
    }

    public function checkin()
    {
        return view('checkin',['nombre'=>'checkin']);
    }




    public function update(Request $request)
    {

        $id=$request->input('id');
        $cUser = Auth::user()->id;
        if($cUser == $id){
            $input = $request->all();
            $usuario = User::findOrFail($id);
            $usuario->fill($input)->save();
        }
        


        return redirect("/");
    }
    public function modificaradmin(Request $request)
    {
        $id=$request->input('id');
        $cUser = Auth::user()->id;
        $user = DB::table('users')->where('id',$id)->get();
        return view('/home',['opcion'=>'modificaradmin', 'nombre' => 'modificaradmin', 'dV'=> $user, 'ruta' => 'update']);


    }



}
