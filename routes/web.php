<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Estimado prestador de servicio que tiene que dar mantenimiento a esta fregadera

        //mire compa, al chile cuando empezamos esto no sabiamos un carajo, tuvimos que improvisar jeje
        // suerte
        //att. los de sistemas
        //pd. si cree que es mas facil volver a hacerlo desde 0, pues hagalo y no este chingando
        //pd2. pura clika 14 alv
        //pd3. Uwu

//Rutas generales
Auth::routes([
    'verify' => false,]);

Route::get('/', function () {
    return redirect('/login');
});

//Route::get('/signup',[App\Http\Controllers\HomeController::class, 'register'])->middleware('guest');

Route::post('update', 'App\Http\Controllers\HomeController@update')->name('update');
Route::post('/registro', 'App\Http\Controllers\Auth\RegisterController@register')->name('registrar');
Route::get('modificaradmin', 'App\Http\Controllers\HomeController@modificaradmin')->name('modificaradmin');

//Rutas Prestador

//Rutas api
Route::name('api.')->group(function () {
    Route::post('/marcar', [App\Http\Controllers\PrestadorController::class, 'marcar'])->middleware('role:admin,checkin,Superadmin')->name('marcar');
    Route::post('/afirmas', [App\Http\Controllers\PrestadorController::class, 'asirgarfirmas'])->name('afirmas')->middleware('role:admin,Superadmin');
    Route::post('/actualizar', [App\Http\Controllers\AdminController::class, 'guardar'])->name('actualizar')->middleware('role:admin,Superadmin');
    Route::post('/actualizarb', [App\Http\Controllers\AdminController::class, 'guardar2'])->name('actualizarb')->middleware('role:admin,Superadmin');
    Route::post('/actualizarcursos1', [App\Http\Controllers\AdminController::class, 'guardarcursos1'])->name('actualizarcursos1')->middleware('role:admin,Superadmin');
    Route::post('/actualizarcursos2', [App\Http\Controllers\AdminController::class, 'guardarcursos2'])->name('actualizarcursos2')->middleware('role:admin,Superadmin');
    Route::post('/actualizarcursos3', [App\Http\Controllers\AdminController::class, 'guardarcursos3'])->name('actualizarcursos3')->middleware('role:admin,Superadmin');
    Route::post('/actualizarstatus', [App\Http\Controllers\AdminController::class, 'guardarstatus'])->name('actualizarstatus')->middleware('role:admin,Superadmin');
    Route::post('/registrovisita', [App\Http\Controllers\AdminController::class, 'registrarVisitas'])->name('registrarVisitas')->middleware('role:admin,Superadmin');
    Route::post('/eliminar', [App\Http\Controllers\AdminController::class, 'destroy'])->middleware('role:admin,Superadmin')->name('eliminar');
    Route::post('/activar', [App\Http\Controllers\AdminController::class, 'activar'])->middleware('role:admin,Superadmin')->name('activar');
    Route::post('/cita_programar', [App\Http\Controllers\AdminController::class, 'cita_programar'])->middleware('role:admin,Superadmin')->name('cita_programar');
    Route::post('/create_premios', [App\Http\Controllers\AdminController::class, 'create_premios'])->middleware('role:admin,Superadmin')->name('create_premios');
    Route::get('/check-in', [App\Http\Controllers\HomeController::class, 'checkin'])->name('checkin')->middleware('role:checkin');
    Route::post('/salidaVisita', [App\Http\Controllers\AdminController::class, 'salidaVisita'])->name('salidaVisita')->middleware('role:admin,Superadmin');
    Route::post('/prestadores_asignados', [App\Http\Controllers\AdminController::class, 'prestadores_asignados'])->name('prestadores_asignados')->middleware('role:admin,Superadmin');
    Route::post('/impresion_terminada', [App\Http\Controllers\AdminController::class, 'impresion_terminada'])->name('impresion_terminada')->middleware('role:admin,Superadmin');
    Route::post('/actividad_asignada', [App\Http\Controllers\AdminController::class, 'actividad_asignada'])->name('actividad_asignada')->middleware('role:admin,Superadmin');

});
Route::name('cliente.')->group(function () {
    Route::get('/home',[App\Http\Controllers\VisitanteController::class, 'principal'])->name('home')->middleware('role:clientes');
    Route::get('/visita',[App\Http\Controllers\VisitanteController::class,'visita'])->name('visitas')->middleware('role:clientes');
    Route::post('/confirmar_cita',[App\Http\Controllers\VisitanteController::class, 'confirmar_cita'])->name('confirmar_cita')->middleware('role:clientes');
    Route::post('/cita',[App\Http\Controllers\VisitanteController::class, 'guardarCita'])->name('cita')->middleware('role:clientes');
    Route::post('/visitaguardar',[App\Http\Controllers\VisitanteController::class, 'guardarVisita'])->name('guardarVisita')->middleware('role:clientes');

    Route::get('/registro',[App\Http\Controllers\VisitanteController::class, 'registro'])->name('registro')->middleware('role:clientes');
    Route::get('/registro_modificar',[App\Http\Controllers\VisitanteController::class, 'registro_modificar'])->name('registro_modificar')->middleware('role:clientes');
    Route::post('/ActualizarCita',[App\Http\Controllers\VisitanteController::class, 'ActualizarCita'])->name('ActualizarCita')->middleware('role:clientes');

});
Route::name('admin.')->group(function () {
    Route::get('/admin/home', [App\Http\Controllers\AdminController::class, 'home'])->name('home')->middleware('role:admin,Superadmin');
    Route::get('/admin/registrovisitas', [App\Http\Controllers\AdminController::class, 'registroVisitas'])->name('registrovisitas')->middleware('role:admin,Superadmin');
    Route::get('/admin/registro', [App\Http\Controllers\AdminController::class, 'registro'])->name('registro')->middleware('role:admin,Superadmin');
    Route::get('/admin/modificar', 'App\Http\Controllers\AdminController@modificar')->name('modificar')->middleware('role:admin,Superadmin');
    Route::get('/admin/prestadores', [App\Http\Controllers\AdminController::class, 'prestadores'])->name('prestadores')->middleware('role:admin,Superadmin');
    Route::get('/admin/administradores', [App\Http\Controllers\AdminController::class, 'administradores'])->name('administradores')->middleware('role:Superadmin');
    Route::get('/admin/clientes', [App\Http\Controllers\AdminController::class, 'clientes'])->name('clientes')->middleware('role:admin,Superadmin');
    Route::get('/admin/citas', [App\Http\Controllers\AdminController::class, 'citas'])->name('citas')->middleware('role:admin,Superadmin');
    Route::get('/admin/prestadoresPendientes', [App\Http\Controllers\AdminController::class, 'prestadoresPendientes'])->name('prestadoresPendientes')->middleware('role:admin,Superadmin');
    Route::post('/admin/descargarArchivo', [App\Http\Controllers\AdminController::class, 'descargarArchivo'])->name('descargarArchivo')->middleware('role:admin,Superadmin');
    Route::post('/admin/verImagenCredencial', [App\Http\Controllers\AdminController::class, 'verCredencial'])->name('verCredencial')->middleware('role:admin,Superadmin');
    Route::post('/admin/verImagenRender', [App\Http\Controllers\AdminController::class, 'verRender'])->name('verRender')->middleware('role:admin,Superadmin');
    Route::get('/admin/firmas', [App\Http\Controllers\AdminController::class, 'firmas'])->name('firmas')->middleware('role:admin,Superadmin');
    Route::get('/admin/firmasPendientes', [App\Http\Controllers\AdminController::class, 'firmasPendientes'])->name('firmasPendientes')->middleware('role:admin,Superadmin');
    Route::get('/admin/recompensasRegistro', [App\Http\Controllers\AdminController::class, 'recompensas'])->name('recompensas')->middleware('role:admin,Superadmin');
    Route::get('/admin/C_actividades', [App\Http\Controllers\AdminController::class, 'C_Actividades'])->name('C_Actividades')->middleware('role:admin,Superadmin');
    Route::get('/admin/check-in', [App\Http\Controllers\AdminController::class, 'checkin'])->name('checkin')->middleware('role:admin,Superadmin');
    Route::get('/admin/premios', [App\Http\Controllers\AdminController::class, 'premios'])->name('premios')->middleware('role:admin,Superadmin');
    Route::post('/admin/update', 'App\Http\Controllers\AdminController@adminUpdate')->name('update')->middleware('role:admin,Superadmin');
    Route::get('/admin/visitas', [App\Http\Controllers\AdminController::class, 'visitas'])->name('visitas')->middleware('role:admin,Superadmin');
    Route::get('/admin/general', [App\Http\Controllers\AdminController::class, 'general'])->name('general')->middleware('role:admin,Superadmin');
    Route::get('/admin/prestadoresProyectos', [App\Http\Controllers\AdminController::class, 'prestadoresProyectos'])->name('prestadoresProyectos')->middleware('role:admin,Superadmin');
    Route::get('/admin/ProyectosCitados', [App\Http\Controllers\AdminController::class, 'ProyectosCitados'])->name('ProyectosCitados')->middleware('role:admin,Superadmin');
    Route::get('/admin/excel', [App\Http\Controllers\AdminController::class, 'Excel'])->name('excel')->middleware('role:admin,Superadmin');
    Route::get('/admin/activarregistros', [App\Http\Controllers\AdminController::class, 'activarregistros'])->name('activarregistros')->middleware('role:admin,Superadmin');



    Route::get('/admin/ProyectosPendientes', [App\Http\Controllers\AdminController::class, 'ProyectosPendientes'])->name('ProyectosPendientes')->middleware('role:admin,Superadmin');
    Route::get('/admin/ProyectosAprovados', [App\Http\Controllers\AdminController::class, 'ProyectosAprovados'])->name('ProyectosAprovados')->middleware('role:admin,Superadmin');
    Route::post('/admin/AprobarProyecto', [App\Http\Controllers\AdminController::class, 'AprobarProyecto'])->name('AprobarProyecto')->middleware('role:admin,Superadmin');
    Route::post('/admin/RechazarProyecto', [App\Http\Controllers\AdminController::class, 'RechazarProyecto'])->name('RechazarProyecto')->middleware('role:admin,Superadmin');

    Route::post('/admin/viewProyecto',[App\Http\Controllers\AdminController::class, 'viewProyecto'])->name('viewProyecto')->middleware('role:admin,Superadmin,clientes');
    Route::get('/admin/PDFProyecto', [App\Http\Controllers\AdminController::class, 'PDFProyecto'])->name('PDFProyecto')->middleware('role:admin,Superadmin,clientes');
});

Route::name('email.')->group(function () {
    Route::get('visitante/correo', [App\Http\Controllers\MailController::class,'sendEmail'])->name('impresion')->middleware('role:clientes');
});

Route::name('ss.')->group(function () {
    Route::get('/sshorasP', [App\Http\Controllers\empController::class,'sshorasP'])->name('sshorasP')->middleware('role:admin,Superadmin');
    Route::get('/ssprestadoresA', [App\Http\Controllers\empController::class,'ssPrestadoresA'])->name('ssPrestadoresA')->middleware('role:admin,Superadmin');
    Route::get('/ssprestadoresP', [App\Http\Controllers\empController::class,'ssPrestadoresP'])->name('ssPrestadoresP')->middleware('role:admin,Superadmin');
    Route::get('/ssclientes', [App\Http\Controllers\empController::class,'ssClientes'])->name('ssClientes')->middleware('role:admin,Superadmin');
    Route::get('/ssadministradores', [App\Http\Controllers\empController::class,'ssAdministradores'])->name('ssAdministradores')->middleware('role:admin,Superadmin');
    Route::get('/sscitas', [App\Http\Controllers\empController::class,'ssCitas'])->name('ssCitas')->middleware('role:admin,Superadmin');
    Route::get('/ssFirmaspendientes', [App\Http\Controllers\empController::class,'ssFirmaspendientes'])->name('ssFirmaspendientes')->middleware('role:admin,Superadmin');
    Route::get('/sstablaprestadores', [App\Http\Controllers\empController::class,'sstablaprestadores'])->name('sstablaprestadores')->middleware('role:admin,Superadmin,prestador');
    Route::get('/sstablavisitas', [App\Http\Controllers\empController::class,'sstablavisitas'])->name('sstablavisitas')->middleware('role:admin,Superadmin');
    Route::get('/sstablausuarios', [App\Http\Controllers\empController::class,'sstablaUserGeneral'])->name('sstablausuarios')->middleware('role:admin,Superadmin');
    Route::get('/ssssPrestadoresProyectos', [App\Http\Controllers\empController::class,'ssPrestadoresProyectos'])->name('ssPrestadoresProyectos')->middleware('role:admin,Superadmin');
    Route::get('/ssProyectosCitados', [App\Http\Controllers\empController::class,'ssProyectosCitados'])->name('ssProyectosCitados')->middleware('role:admin,Superadmin');
    Route::get('/ssImpresionesTerminadas', [App\Http\Controllers\empController::class,'ssImpresionesTerminadas'])->name('ssImpresionesTerminadas')->middleware('role:prestador');
    Route::get('/ssActividadTerminada', [App\Http\Controllers\empController::class,'ssActividadTerminada'])->name('ssActividadTerminada')->middleware('role:prestador');

    Route::get('/ssProyectosAprovados', [App\Http\Controllers\empController::class,'ssProyectosAprovados'])->name('ssProyectosAprovados')->middleware('role:admin,Superadmin');
    Route::get('/ssProyectosPendientes', [App\Http\Controllers\empController::class,'ssProyectosPendientes'])->name('ssProyectosPendientes')->middleware('role:admin,Superadmin');
});
Route::get('/bot', function () {
    return view('boot');
});
Route::match(['get', 'post'], '/botman', [App\Http\Controllers\BotManController::class, 'handle']);

    /*
    Route::name('email.')->group(function () {
        Route::get('impresion', function () {

            $details = [
                'title' => 'Solicitud de impresion',
                'body' => 'mensaje de prueba para la solicitud de impresion'
            ];

            \Mail::to('eduardo.guerrero7430@alumnos.udg.mx')->send(new \App\Mail\Email($details));

            dd("Email is Sent.");
        })->name('impresion');
    });

*/

// Route::name('prestador.')->group(function () {
//    Route::post('/marcar', [App\Http\Controllers\PrestadorController::class, 'marcar'])->middleware('role:admin,checkin,Superadmin')->name('marcar');
//});










