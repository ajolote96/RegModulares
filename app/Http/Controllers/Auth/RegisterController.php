<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        switch($data['tipo']){
            case 'admin':
                $rHoras =  ['nullable'];
                $rCarrera = ['nullable'];
                $rCodigo = ['nullable'];
                break;
            case 'prestadorp':
                $rHoras =  ['required'];
                $rCarrera = ['required','string'];
                $rCodigo = ['required','string','unique:users'];
                break;
            case 'prestador':
                $rHoras =  ['required'];
                $rCarrera = ['required','string'];
                $rCodigo = ['required','string','unique:users'];
                break;
            case 'clientes':
                switch($data['tipo_cliente']){
                    case 'Alumno':
                    case 'Maestro':
                        $rHoras =  ['nullable'];
                        $rCarrera = ['required','string'];
                        $rCodigo = ['required','string','unique:users'];
                        break;
                    case 'Otro':
                        $rHoras =  ['nullable'];
                        $rCarrera = ['nullable'];
                        $rCodigo = ['nullable'];
                }
                break;
        }

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'codigo' => $rCodigo,
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'tipo' => ['required', 'string'],
            'correo' => ['required', 'email', 'unique:users'],
            'horas' => $rHoras,
            'carrera' => $rCarrera,
            'tipo_cliente' => ['nullable']

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        switch($data['tipo']){
            case 'admin':
                $vHoras =  null;
                $vCarrera = null;
                $vCodigo = null;
                $vTipo_cliente = null;
                break;
            case 'prestador':
                $vHoras =  $data['horas'];
                $vCarrera = $data['carrera'];
                $vCodigo = $data['codigo'];
                $vTipo_cliente = null;
                break;
            case 'prestadorp':
                $vHoras =  $data['horas'];
                $vCarrera = $data['carrera'];
                $vCodigo = $data['codigo'];
                $vTipo_cliente = null;
                break;
            case 'clientes':
                switch($data['tipo_cliente']){
                    case 'Alumno':
                    case 'Maestro':
                        $vHoras =  null;
                        $vCarrera = $data['carrera'];
                        $vCodigo = $data['codigo'];
                        $vTipo_cliente = $data['tipo_cliente'];
                        break;
                    case 'Otro':
                        $vHoras =  null;
                        $vCarrera = null;
                        $vCodigo = null;
                        $vTipo_cliente = $data['tipo_cliente'];
                }
                break;
        }
        return User::create([
            'name' => $data['name'],
            'apellido' => $data['apellido'],
            'codigo' => $vCodigo,
            'password' => Hash::make($data['password']),
            'tipo' => $data['tipo'],
            'correo' => $data['correo'],
            'horas' => $vHoras,
            'carrera' => $vCarrera,
            'tipo_cliente' => $vTipo_cliente
        ]);
    }
}
