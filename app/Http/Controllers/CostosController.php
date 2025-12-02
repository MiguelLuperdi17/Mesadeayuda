<?php

namespace App\Http\Controllers;

//use App\Imports\UsuariosImport;
use App\Imports\CostosImport;
use App\Models\Atencion;
use App\Models\Ccosto;
use App\Models\RolPermiso;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class CostosController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $permiso = RolPermiso::where('per_id', 12)->where('rol_id', $user->rol_id)->count();
//        dd($user->change_pass);
        $last_change_date = Carbon::createFromFormat('Y-m-d H:i:s', ($user->change_pass != null ? $user->change_pass : $user->created_at));
        $diffInDays = Carbon::now()->diffInDays($last_change_date);
        $variable = $user->id;
        if ($permiso == 0) {
            return redirect()->back();
        }
        if ($diffInDays > 90) {
            Session::flash('flash_message', 'Debe actualizar su contraseña');
            Session::flash('alert-class', 'alert-danger');
            return redirect('password_change');
        }
        //////
        ///
        $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        ///
        //////
        $all_user = User::all();
        $atenciones = Atencion::all();
        $Total = Ticket::getCantidad();
        $creados = Ticket::whereIn('estado', ['F', 'T'])
            ->whereBetween('fecha_creacion', [Carbon::now()->subDays(7), Carbon::now()]) // Rango de fechas
            ->get();
        $finalizados = Ticket::whereIn('estado', ['F', 'T'])
            ->whereBetween('fecha_cierre', [Carbon::now()->subDays(7), Carbon::now()]) // Rango de fechas
            ->get();
        $user_fin = [];
        $cantidad_fin = [];
        $diferencia_fin = [];
        $sla_fin = [];
        $slacount_fin = [];
        $primer_I = Ticket::whereHas('atencion', function ($query) {
            $query->where('tipo', 'I');
        })
            ->whereIn('estado', ['A', 'P'])
            ->whereNotNull('fecha_asignacion')
            ->orderBy('fecha_creacion', 'asc')
            ->first(); // Obtener el primero

        $primer_R = Ticket::whereHas('atencion', function ($query) {
            $query->where('tipo', 'R');
        })
            ->whereIn('estado', ['A', 'P'])
            ->whereNotNull('fecha_asignacion')
            ->orderBy('fecha_creacion', 'asc')
            ->first(); // Obtener el primero
        $pendientes = Ticket::getListaPendientesReporte();
        $user_pendiente = [];
        $cantidada_pendiente = [];
        $tipo = [];
        $cantidad_tipo = [];
        foreach ($pendientes as $pendiente) {
            /////////////////////////////////////////////////////////////////
            /// Gráfico 1
            /////////////////////////////////////////////////////////////////
            $username = $pendiente->user ? $pendiente->user->username : 'Sin_Asignar';
            $user_pendiente[$username] = $username;
            if (!isset($cantidada_pendiente[$username])) {
                $cantidada_pendiente[$username] = 0;
            }
            $cantidada_pendiente[$username]++;
            /////////////////////////////////////////////////////////////////
            /// Gráfico 2
            /////////////////////////////////////////////////////////////////
            if($pendiente->fecha_asignacion){
                $tipo[$pendiente->atencion->tipo] = $pendiente->atencion->tipo;
                if (!isset($cantidad_tipo[$pendiente->atencion->tipo])) {
                    $cantidad_tipo[$pendiente->atencion->tipo] = 0;
                }
                $cantidad_tipo[$pendiente->atencion->tipo]++;
            }else{
                if (!isset($cantidad_tipo['En_Blanco'])) {
                    $cantidad_tipo['En_Blanco'] = 0;
                }
                $tipo['En_Blanco'] = 'En_Blanco';
                $cantidad_tipo['En_Blanco']++;
            }
        }
        $periodo = Carbon::now()->translatedFormat('F-Y');
        $p_costos = Ccosto::getListaPendiente($periodo);

        $detalle_meses = Ccosto::select('mes')
            ->selectRaw('SUM(total) as total')
            ->orderBy('mes', 'desc')
            ->groupBy('mes')
            ->get();
        $desc_meses = [];
        $monto_meses = [];
        $desc_meses []= 'Ago-2024';
        $monto_meses []= '9518.05';
        $desc_meses []= 'Set-2024';
        $monto_meses []= '9897.49';
        $desc_meses []= 'Oct-2024';
        $monto_meses []= '9897.50';
        $desc_meses []= 'Nov-2024';
        $monto_meses []= '9775.48';
        $desc_meses []= 'Dic-2024';
        $monto_meses []= '9831.67';
        $desc_meses []= 'Ene-2025';
        $monto_meses []= '9831.67';
        //CECO
        $ceco_d=[];
        $ceco_c=[];
        $ceco_d[]='1020230301';
        $ceco_c[]='1075.9';
        $ceco_d[]='1020230304';
        $ceco_c[]='942.2';
        $ceco_d[]='1020231201';
        $ceco_c[]='624.3';
        $ceco_d[]='1020231204';
        $ceco_c[]='598.16';
        $ceco_d[]='1030330204';
        $ceco_c[]='319.77';
        $ceco_d[]='1020230401';
        $ceco_c[]='302.16';
        $ceco_d[]='1020231301';
        $ceco_c[]='267';
        //Año
        $año_d=[];
        $año_c=[];
        $año_d[]='2024';
        $año_c[]='28920.19';
        $año_d[]= '2025';
        $año_c[]= '9831.67';

        //foreach ($detalle_meses as $detalle) {
        //    $monto_meses []= $detalle->total;
        //    $desc_meses []= $detalle->mes;
        //}

        return view('distribucion.index', compact('variable', 'Total', 'pendientes', 'all_user',
            'atenciones', 'user_pendiente', 'cantidada_pendiente','tipo', 'cantidad_tipo','primer_I','primer_R','user_fin',
            'cantidad_fin','finalizados','creados','diferencia_fin','meses','p_costos','monto_meses','desc_meses','ceco_d',
            'ceco_c','año_d','año_c'));
    }
    public function import_costos(Request $request)
    {

            $request->validate([
                'archivo' => 'required|file|mimes:xlsx,csv,xls',
            ]);
            $mes = strtolower($request->mes)."-".Carbon::now()->year;
            $exist = Ccosto::where('mes', $mes)->first();
            if ($exist){
                Session::flash('flash_message', 'El mes seleccionado ya existe en el sistema.');
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
            }
            // Importa el archivo
            Excel::import(new CostosImport($mes), $request->file('archivo'));

            Session::flash('flash_message', 'Datos Importados Correctamente');
            Session::flash('alert-class', 'alert-success');
            return redirect()->back();
    }

    public function aprobar_costo(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'id' => 'required|string',
        ]);
        $mes = $request->mes."-".Carbon::now()->year;
        $username = $request->input('username');

        // Cambiar el estado del registro (ajusta esto según tu modelo)
        $pendiente = UserPendiente::where('username', $username)->first();

        if ($pendiente) {
            // Aquí puedes cambiar el estado o eliminar el registro según tu lógica
            $pendiente->estado = 'aprobado'; // O cualquier lógica que necesites
            $pendiente->save();

            // Si prefieres eliminar el registro en lugar de cambiar el estado
            // $pendiente->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Registro no encontrado.'], 404);
    }
    public function palermo()
    {
        $user = Auth::user();
        $permiso = RolPermiso::where('per_id', 12)->where('rol_id', $user->rol_id)->count();
//        dd($user->change_pass);
        $last_change_date = Carbon::createFromFormat('Y-m-d H:i:s', ($user->change_pass != null ? $user->change_pass : $user->created_at));
        $diffInDays = Carbon::now()->diffInDays($last_change_date);
        $variable = $user->id;
        if ($permiso == 0) {
            return redirect()->back();
        }
        if ($diffInDays > 90) {
            Session::flash('flash_message', 'Debe actualizar su contraseña');
            Session::flash('alert-class', 'alert-danger');
            return redirect('password_change');
        }
        //////
        ///
        $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        ///
        //////
        $all_user = User::all();
        $atenciones = Atencion::all();
        $Total = Ticket::getCantidad();
        $creados = Ticket::whereIn('estado', ['F', 'T'])
            ->whereBetween('fecha_creacion', [Carbon::now()->subDays(7), Carbon::now()]) // Rango de fechas
            ->get();
        $finalizados = Ticket::whereIn('estado', ['F', 'T'])
            ->whereBetween('fecha_cierre', [Carbon::now()->subDays(7), Carbon::now()]) // Rango de fechas
            ->get();
        $user_fin = [];
        $cantidad_fin = [];
        $diferencia_fin = [];
        $sla_fin = [];
        $slacount_fin = [];
        $primer_I = Ticket::whereHas('atencion', function ($query) {
            $query->where('tipo', 'I');
        })
            ->whereIn('estado', ['A', 'P'])
            ->whereNotNull('fecha_asignacion')
            ->orderBy('fecha_creacion', 'asc')
            ->first(); // Obtener el primero

        $primer_R = Ticket::whereHas('atencion', function ($query) {
            $query->where('tipo', 'R');
        })
            ->whereIn('estado', ['A', 'P'])
            ->whereNotNull('fecha_asignacion')
            ->orderBy('fecha_creacion', 'asc')
            ->first(); // Obtener el primero
        $pendientes = Ticket::getListaPendientesReporte();
        $user_pendiente = [];
        $cantidada_pendiente = [];
        $tipo = [];
        $cantidad_tipo = [];
        foreach ($pendientes as $pendiente) {
            /////////////////////////////////////////////////////////////////
            /// Gráfico 1
            /////////////////////////////////////////////////////////////////
            $username = $pendiente->user ? $pendiente->user->username : 'Sin_Asignar';
            $user_pendiente[$username] = $username;
            if (!isset($cantidada_pendiente[$username])) {
                $cantidada_pendiente[$username] = 0;
            }
            $cantidada_pendiente[$username]++;
            /////////////////////////////////////////////////////////////////
            /// Gráfico 2
            /////////////////////////////////////////////////////////////////
            if($pendiente->fecha_asignacion){
                $tipo[$pendiente->atencion->tipo] = $pendiente->atencion->tipo;
                if (!isset($cantidad_tipo[$pendiente->atencion->tipo])) {
                    $cantidad_tipo[$pendiente->atencion->tipo] = 0;
                }
                $cantidad_tipo[$pendiente->atencion->tipo]++;
            }else{
                if (!isset($cantidad_tipo['En_Blanco'])) {
                    $cantidad_tipo['En_Blanco'] = 0;
                }
                $tipo['En_Blanco'] = 'En_Blanco';
                $cantidad_tipo['En_Blanco']++;
            }
        }
        $periodo = Carbon::now()->translatedFormat('F-Y');
        $p_costos = Ccosto::getListaPendiente($periodo);

        $detalle_meses = Ccosto::select('mes')
            ->selectRaw('SUM(total) as total')
            ->orderBy('mes', 'desc')
            ->groupBy('mes')
            ->get();
        $desc_meses = [];
        $monto_meses = [];
        $desc_meses []= 'Ago-2024';
        $monto_meses []= '2318.00';
        $desc_meses []= 'Sep-2024';
        $monto_meses []= '2258.49';
        $desc_meses []= 'Oct-2024';
        $monto_meses []= '3190.10';
        $desc_meses []= 'Nov-2024';
        $monto_meses []= '2519.48';
        $desc_meses []= 'Dic-2024';
        $monto_meses []= '2519.00';
        //$desc_meses []= 'Ene-2025';
        //$monto_meses []= '9831.67';
        //CECO
        $ceco_d=[];
        $ceco_c=[];
        $ceco_d[]='CAMPO';
        $ceco_c[]='310.97';
        $ceco_d[]='Fabrica 1°';
        $ceco_c[]='302.85';
        $ceco_d[]='T. Agrícola';
        $ceco_c[]='180.56';
        $ceco_d[]='RRHH 5002';
        $ceco_c[]='156.03';
        $ceco_d[]='APT';
        $ceco_c[]='153.69';
        $ceco_d[]='RRHH 550';
        $ceco_c[]='128.40';
        $ceco_d[]='Tesorería';
        $ceco_c[]='126.76';
        //Año
        $año_d=[];
        $año_c=[];
        $año_d[]='2024';
        $año_c[]='12805.07';
        //$año_d[]= '2025';
        //$año_c[]= '9831.67';

        //foreach ($detalle_meses as $detalle) {
        //    $monto_meses []= $detalle->total;
        //    $desc_meses []= $detalle->mes;
        //}

        return view('distribucion.palermo', compact('variable', 'Total', 'pendientes', 'all_user',
            'atenciones', 'user_pendiente', 'cantidada_pendiente','tipo', 'cantidad_tipo','primer_I','primer_R','user_fin',
            'cantidad_fin','finalizados','creados','diferencia_fin','meses','p_costos','monto_meses','desc_meses','ceco_d',
            'ceco_c','año_d','año_c'));
    }
}
