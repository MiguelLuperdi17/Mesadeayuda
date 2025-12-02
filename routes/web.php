<?php

use App\Http\Controllers\BalancesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\CotizacionesController;
use App\Http\Controllers\GuiasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\MaterialesController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RolPermisoController;
use App\Http\Controllers\UbicacionesController;
use App\Http\Controllers\UsuarioController;
use App\Models\Cotizaciones;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\SelectionController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\CostosController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\SolucionController;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use App\Models\Proveedor;

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

Route::get('/', function () {
    return view('auth/login');
});

Route::get('politicas_de_privacidad', function () {
    return view('auth/politicas');
});

Route::get('/dump-autoload', function () {
    $process = new Process(['composer dump-autoload']);
    $process->run();

    // Verificar si ocurrió un error al ejecutar el proceso
    if (!$process->isSuccessful()) {
        throw new ProcessFailedException($process);
    }

    return 'Composer dump-autoload ejecutado con éxito. Salida: ' . $process->getOutput();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/', HomeController::class);

    Route::post('MisComentarios', [ComentarioController::class, 'MisComentarios']);
    Route::post('crear_comentario', [ComentarioController::class, 'create'])->name('crear_comentario');
    //Route::get('/send-test-email', function () {
    //    Mail::to('miguel.luperdi@agroindustriallaredo.com')->send(new TestEmail());
    //    return 'Correo de prueba enviado!';
    //});

    Route::get('Api_glpi', [TicketController::class, 'prueba_api']);
    Route::get('Api_prueba_detalle/{id}', [TicketController::class, 'prueba_api_detalle']);

    Route::get('/equipos-usuario/{user}', [EquipoController::class, 'getEquiposUsuario']);
    Route::get('/soluciones-atencion/{atencion_id}', [EquipoController::class, 'getSolucionesPorAtencion']);
    Route::get('/soluciones-atencion/detalle/{id}', [EquipoController::class, 'getDetalleSolucion']);
    Route::post('/upload-image', [EquipoController::class, 'store'])->name('ckeditor.upload');

    Route::get('base_conocimiento', [EquipoController::class, 'vista_baseconocimiento']);
    Route::get('/soluciones/{atencion_id}', [EquipoController::class, 'obtenerSolucionesPorAtencion'])->name('soluciones.atencion');
    Route::get('bc_equipos', [EquipoController::class, 'vista_bc_equipos']);
    Route::get('/soluciones-equipo/{equipo}', [EquipoController::class, 'getSolucionesPorEquipo']);


    Route::get('/soluciones_vista', [SolucionController::class, 'vistaAdmin']);
    Route::get('/admin/soluciones/listar/{atencion?}', [SolucionController::class, 'listar']);
    Route::post('/admin/soluciones/estado/{id}', [SolucionController::class, 'cambiarEstado']);
    Route::get('/soluciones_vista/{id}', [SolucionController::class, 'edit']);
    Route::put('/soluciones_editar/{id}', [SolucionController::class, 'update']);
    Route::delete('/soluciones_eliminar/{id}', [SolucionController::class, 'delete']);


    //Crear ticket
    Route::get('MisTickets', [TicketController::class, 'index']);
    Route::post('crear_ticket', [TicketController::class, 'create'])->name('crear_ticket');
    //Asignar Ticket
    Route::get('Asignar', [TicketController::class, 'vista_asignar']);
    Route::post('anular_ticket', [TicketController::class, 'anular_ticket'])->name('anular_ticket');
    Route::post('asignar_ticket', [TicketController::class, 'asignar_ticket'])->name('asignar_ticket');
    Route::post('cerrar_ticket', [TicketController::class, 'cerrar_ticket'])->name('cerrar_ticket');
    Route::post('cerrar_incidentes', [TicketController::class, 'cerrar_incidentes'])->name('cerrar_incidentes');

    Route::post('/update-ticket', [TicketController::class, 'updateTicket']);
    Route::post('/update-approver', [SelectionController::class, 'updateApprover']);
    Route::get('/get-selected-items', [SelectionController::class, 'getSelectedItems']);
    Route::post('/save-approvers', [SelectionController::class, 'saveApprovers']);
    Route::post('/save-selected-items', [SelectionController::class, 'saveSelectedItems']);
    //Registrar Solución
    Route::get('Solucionar', [TicketController::class, 'vista_solucionar']);
    //Nuevo Ticket Usuario
    Route::get('/get-dato', [TicketController::class, 'obtenerDato'])->name('get.dato');
    //Seguimiento Tickets
    Route::get('Seguimiento', [TicketController::class, 'vista_seguimiento']);
    Route::get('Consultar', [TicketController::class, 'vista_consulta']);
    Route::post('reasignar_ticket', [TicketController::class, 'reasignar_ticket'])->name('reasignar_ticket');
    //Consulta Tickets
    //Material de Ayuda
    Route::get('Materiale', [TicketController::class, 'vista_material']);
    //Autorizaciones
    Route::get('Aprobar', [TicketController::class, 'vista_aprobar']);
    Route::post('rechazar_ticket', [TicketController::class, 'rechazar_ticket'])->name('rechazar_ticket');
    Route::post('aprobar_ticket', [TicketController::class, 'aprobar_ticket'])->name('aprobar_ticket');
    //Permisos
    Route::resource('permisos', PermisoController::class);

    route::resource('permisos-por-rol', RolPermisoController::class);
    Route::get('/permiso/{usuario}', [RolPermisoController::class, 'getProyectos']);
    Route::post('permisos_guardar', [RolPermisoController::class, 'permisos_guardar'])->name('permisos_guardar');
    Route::post('/permiso/ver_permiso_asignado', [RolPermisoController::class, 'ver_permiso_asignado']);
    Route::post('/permiso/ver_permiso_no_asignado', [RolPermisoController::class, 'ver_permiso_no_asignado']);
    Route::post('/permiso/asignar_permiso', [RolPermisoController::class, 'asignar_permiso']);
    Route::post('/permiso/quitar_permiso', [RolPermisoController::class, 'quitar_permiso']);

    //Reportes
    Route::get('reportes', [ReporteController::class, 'index']);
    Route::post('reportes_filtro', [ReporteController::class, 'vista_filtro_fechas']);
    Route::post('pendientes', [ReporteController::class, 'vista_pendientes']);
    Route::post('finalizados', [ReporteController::class, 'vista_finalizados']);

    //Proyectos
    Route::get('proyectos', [ProyectosController::class, 'index']);
    Route::post('crear_proyecto', [ProyectosController::class, 'create']);
    Route::get('aprobar_proyecto/{id}', [ProyectosController::class, 'aprobar_proyecto'])->name('aprobar_proyecto/{id}');
    Route::post('fechas_hitos', [ProyectosController::class, 'fechas_hitos'])->name('fechas_hitos');
    Route::post('rechazar_proyecto', [ProyectosController::class, 'rechazar_proyecto'])->name('rechazar_proyecto');
    Route::get('programa_hitos/{id}', [ProyectosController::class, 'programa_hitos'])->name('programa_hitos/{id}'); //hitos
    Route::post('MisComentarios_hito', [ProyectosController::class, 'MisComentarios_hito']);
    Route::post('crear_comentario_hito', [ProyectosController::class, 'comentario'])->name('crear_comentario_hito');
    Route::post('finalizar_hito', [ProyectosController::class, 'finalizar_hito'])->name('finalizar_hito');
    Route::get('reportes_proyectos', [ProyectosController::class, 'reportes_proyectos'])->name('reportes_proyectos/{id}');
    Route::post('pendientes_proyecto', [ProyectosController::class, 'pendientes_proyecto']);

    //Proveedores
    Route::get('Ticket_Proveedores', [ProveedorController::class, 'index']);
    Route::get('Proveedores', [ProveedorController::class, 'vista_proveedores']);
    Route::get('Proveedores_reporte', [ProveedorController::class, 'vista_proveedores_reporte']);
    Route::post('crear_ticket_prov', [ProveedorController::class, 'crear_ticket_prov'])->name('crear_ticket_prov');
    Route::post('crear_proveedor', [ProveedorController::class, 'crear_proveedor'])->name('crear_proveedor');
    Route::get('Reporte_proveedor', [ProveedorController::class, 'vista_reporte']);
    Route::post('finalizar_ticket_prov', [ProveedorController::class, 'finalizar_ticket_prov'])->name('finalizar_ticket_prov');
    Route::post('pendientes_proveedores', [ProveedorController::class, 'pendientes_proveedores']);


    //Usuarios y Roles
    Route::get('usuarios', [UsuarioController::class, 'index']);
    Route::post('guardar_usuario', [UsuarioController::class, 'guardar_user'])->name('guardar_usuario');
    Route::post('editar_usuario/{id}', [UsuarioController::class, 'editar_user'])->name('editar_usuario');
    Route::delete('eliminar_usuario/{id}', [UsuarioController::class, 'eliminar_user'])->name('eliminar_usuario');

    //Import Claro
    Route::get('Costos_telefonos', [CostosController::class, 'index']);
    Route::get('Costos_palermo', [CostosController::class, 'palermo']);
    Route::post('import_costos', [CostosController::class, 'import_costos']);
    Route::post('/aprobar_costo', [CostosController::class, 'aprobar_costo']);

    Route::get('perfil', [PerfilController::class, 'home'])->name('perfil');
    Route::get('password', [PerfilController::class, 'password'])->name('password');
    Route::get('password_change', [PerfilController::class, 'password_change'])->name('password_change');
    Route::get('psswrd', [PerfilController::class, 'psswrd'])->name('psswrd');
    Route::post('foto_perfil', [PerfilController::class, 'subir_imagen'])->name('foto_perfil');
    Route::post('actualizar_datos', [PerfilController::class, 'editar_perfil']);
    Route::post('actualizar_password', [PerfilController::class, 'actualizar_password']);
    //Mesa de Ayuda

    //USUARIOS

});
