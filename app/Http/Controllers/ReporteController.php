<?php

namespace App\Http\Controllers;

use App\Models\Atencion;
use App\Models\RolPermiso;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReporteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $permiso = RolPermiso::where('per_id', 11)->where('rol_id', $user->rol_id)->count();
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
        $all_user = User::all();
        $atenciones = Atencion::all();
        $Total = Ticket::getCantidad();
        $startDate = Carbon::now()->subDays(7)->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        $creados = Ticket::whereBetween('fecha_creacion', [$startDate, $endDate]) // Rango de fechas
            ->get();
        $finalizados = Ticket::whereIn('estado', ['F', 'T'])
            ->whereBetween('fecha_cierre', [$startDate, $endDate]) // Rango de fechas
            ->get();
        $user_fin = [];
        $cantidad_fin = [];
        $diferencia_fin = [];
        $sla_fin = [];
        $slacount_fin = [];
        foreach ($finalizados as $finalizado) {
            $username_f = $finalizado->user ? $finalizado->user->username : 'Sin_Asignar';
            $user_fin[$username_f] = $username_f;
            if (!isset($cantidad_fin[$username_f])) {
                $cantidad_fin[$username_f] = 0;
            }
            if (!isset($diferencia_fin[$username_f])) {
                $diferencia_fin[$username_f] = 0;
            }
            if (!isset($sla_fin[$username_f])) {
                $sla_fin[$username_f] = 0;
            }
            if (!isset($slacount_fin[$username_f])) {
                $slacount_fin[$username_f] = 0;
            }
            $fecha_cierre = Carbon::parse($finalizado->fecha_cierre)->startOfDay();
            $fecha_asignacion = Carbon::parse($finalizado->fecha_asignacion)->endOfDay();
            $workingDays = 0;
            $currentDate = $fecha_asignacion->copy();
            while ($currentDate <= $fecha_cierre) {
                if (!in_array($currentDate->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY])) {
                    $workingDays++;
                }
                $currentDate->addDay();
            }
//            $dif = $fecha_cierre->diffInDays($fecha_asignacion);
            $dif = $workingDays;
            $diferencia_fin[$username_f] = $diferencia_fin[$username_f] + $dif;
            $temp = $dif - $finalizado->atencion->atencion;
            $sla_fin[$username_f] = $sla_fin[$username_f] + ($temp > 0 ? $temp : 0);
            $slacount_fin[$username_f] = $slacount_fin[$username_f] + ($temp > 0 ? 1 : 0);
            $cantidad_fin[$username_f]++;
        }
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
            if ($pendiente->fecha_asignacion) {
                $tipo[$pendiente->atencion->tipo] = $pendiente->atencion->tipo;
                if (!isset($cantidad_tipo[$pendiente->atencion->tipo])) {
                    $cantidad_tipo[$pendiente->atencion->tipo] = 0;
                }
                $cantidad_tipo[$pendiente->atencion->tipo]++;
            } else {
                if (!isset($cantidad_tipo['En_Blanco'])) {
                    $cantidad_tipo['En_Blanco'] = 0;
                }
                $tipo['En_Blanco'] = 'En_Blanco';
                $cantidad_tipo['En_Blanco']++;
            }
        }
        $fechaActual = Carbon::now();
        $semanas = collect();
        $M1 = Carbon::now()->previous(Carbon::WEDNESDAY)->endOfDay();
        $M1_F = Carbon::now()->previous(Carbon::WEDNESDAY)->startOfDay();
        $semanas->push([
            'nombre' => 'Semana 1',
            'fecha_inicio' => $M1->startOfDay()->format('Y-m-d'),
            'fecha_fin' => $fechaActual->endOfDay()->format('Y-m-d'),
        ]);
        $M2 = $M1->subWeek();
        $semanas->push([
            'nombre' => 'Semana 2',
            'fecha_inicio' => $M2->format('Y-m-d'),
            'fecha_fin' => $M1_F->format('Y-m-d'),
        ]);
        $M3 = Carbon::now()->subWeeks(2)->previous(Carbon::WEDNESDAY);
        $semanas->push([
            'nombre' => 'Semana 3',
            'fecha_inicio' => $M3->startOfDay()->format('Y-m-d'),
            'fecha_fin' => $M2->endOfDay()->format('Y-m-d'),
        ]);
        $tickets = Ticket::whereNotNull('fecha_cierre')
            ->whereNotNull('asignado')  // Aseguramos que el ticket esté asignado
            ->whereBetween('fecha_cierre', [$M3, $fechaActual])
            ->orderBy('fecha_cierre', 'desc')
            ->get();
        $ticketsPorAnalista = [];
        foreach ($tickets as $ticket) {
            $analista = $ticket->user->username;
            $fechaCierre = Carbon::parse($ticket->fecha_cierre);

            foreach ($semanas as $semana) {
                $inicio = Carbon::parse($semana['fecha_inicio'])->startOfDay();
                $fin = Carbon::parse($semana['fecha_fin'])->endOfDay();

                if ($fechaCierre->between($inicio, $fin)) {
                    $ticketsPorAnalista[$analista][$semana['nombre']][] = $ticket;
                }
            }
        }


        return view('reportes.index', compact('variable', 'Total', 'pendientes', 'all_user',
            'atenciones', 'user_pendiente', 'cantidada_pendiente', 'tipo', 'cantidad_tipo', 'primer_I', 'primer_R', 'user_fin',
            'cantidad_fin', 'finalizados', 'creados', 'diferencia_fin', 'sla_fin', 'slacount_fin', 'startDate', 'endDate','ticketsPorAnalista', 'semanas'));
    }

    private function obtenerTicketsPorSemana($startDate, $endDate) {
        $tickets = Ticket::whereIn('estado', ['F', 'T'])
            ->whereBetween('fecha_cierre', [$startDate, $endDate])
            ->get();

        // Inicializar los datos por analista
        $data = [];
        foreach ($tickets as $ticket) {
            $username = $ticket->user ? $ticket->user->username : 'Sin_Asignar';
            if (!isset($data[$username])) {
                $data[$username] = 0;
            }
            $data[$username]++;
        }

        return $data;
    }

    public function vista_filtro_fechas(Request $request)
    {
        $user = Auth::user();
        $permiso = RolPermiso::where('per_id', 11)->where('rol_id', $user->rol_id)->count();
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
        $all_user = User::all();
        $atenciones = Atencion::all();
        $Total = Ticket::getCantidad();
        $creados = Ticket::whereIn('estado', ['F', 'T'])
            ->whereBetween('fecha_creacion', [Carbon::now()->subDays(7), Carbon::now()]) // Rango de fechas
            ->get();
        $fechaRange = $request->get('rango');
        if ($fechaRange) {
            // Desglosar el rango de fechas
            $dates = explode(' to ', $fechaRange);
            $startDate = $dates[0] ?? null;  // Fecha de inicio
            $endDate = $dates[1] ?? null;    // Fecha de fin
            $startDate = Carbon::createFromFormat('d/m/y', $startDate, 'America/Lima')->startOfDay();
            $endDate = Carbon::createFromFormat('d/m/y', $endDate, 'America/Lima')->endOfDay();
        } else {
            $startDate = Carbon::now()->subDays(7)->startOfDay();
            $endDate = Carbon::now()->endOfDay();
        }
        $finalizados = Ticket::whereIn('estado', ['F', 'T'])
            ->whereBetween('fecha_cierre', [$startDate, $endDate]) // Rango de fechas
            ->get();

            //$finalizados = Ticket::whereIn('estado', ['F', 'T'])
            //->whereBetween('fecha_cierre', [$startDate, $endDate]) // Rango de fechas
            //->whereHas('atencion', function ($query) {
            //    $query->where('tipo', 'I');
            //})
            //->get();
        $user_fin = [];
        $cantidad_fin = [];
        $diferencia_fin = [];
        $sla_fin = [];
        $slacount_fin = [];
        foreach ($finalizados as $finalizado) {
            $username_f = $finalizado->user ? $finalizado->user->username : 'Sin_Asignar';
            $user_fin[$username_f] = $username_f;
            if (!isset($cantidad_fin[$username_f])) {
                $cantidad_fin[$username_f] = 0;
            }
            if (!isset($diferencia_fin[$username_f])) {
                $diferencia_fin[$username_f] = 0;
            }
            if (!isset($sla_fin[$username_f])) {
                $sla_fin[$username_f] = 0;
            }
            if (!isset($slacount_fin[$username_f])) {
                $slacount_fin[$username_f] = 0;
            }
            $fecha_cierre = Carbon::parse($finalizado->fecha_cierre)->startOfDay();
            $fecha_asignacion = Carbon::parse($finalizado->fecha_asignacion)->endOfDay();
            $workingDays = 0;
            $currentDate = $fecha_asignacion->copy();
            while ($currentDate <= $fecha_cierre) {
                if (!in_array($currentDate->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY])) {
                    $workingDays++;
                }
                $currentDate->addDay();
            }
//            $dif = $fecha_cierre->diffInDays($fecha_asignacion);
            $dif = $workingDays;
            $diferencia_fin[$username_f] = $diferencia_fin[$username_f] + $dif;
            $temp = $dif - $finalizado->atencion->atencion;
            $sla_fin[$username_f] = $sla_fin[$username_f] + ($temp > 0 ? $temp : 0);
            $slacount_fin[$username_f] = $slacount_fin[$username_f] + ($temp > 0 ? 1 : 0);
            $cantidad_fin[$username_f]++;
        }
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
            if ($pendiente->fecha_asignacion) {
                $tipo[$pendiente->atencion->tipo] = $pendiente->atencion->tipo;
                if (!isset($cantidad_tipo[$pendiente->atencion->tipo])) {
                    $cantidad_tipo[$pendiente->atencion->tipo] = 0;
                }
                $cantidad_tipo[$pendiente->atencion->tipo]++;
            } else {
                if (!isset($cantidad_tipo['En_Blanco'])) {
                    $cantidad_tipo['En_Blanco'] = 0;
                }
                $tipo['En_Blanco'] = 'En_Blanco';
                $cantidad_tipo['En_Blanco']++;
            }
        }

        $fechaActual = Carbon::now()->endOfDay(); // Fecha actual al final del día
        $semanas = collect();

        // Semana 1
        $M1 = Carbon::now()->previous(Carbon::WEDNESDAY)->startOfDay(); // Inicia a las 00:00
        $M1_F = Carbon::now()->previous(Carbon::WEDNESDAY)->endOfDay(); // Finaliza a las 23:59
        $semanas->push([
            'nombre' => 'Semana 1',
            'fecha_inicio' => $M1->format('Y-m-d H:i:s'),
            'fecha_fin' => $M1_F->format('Y-m-d H:i:s'),
        ]);

        // Semana 2
        $M2 = $M1->subWeek()->startOfDay();
        $M2_F = $M1_F->subWeek()->endOfDay();
        $semanas->push([
            'nombre' => 'Semana 2',
            'fecha_inicio' => $M2->format('Y-m-d H:i:s'),
            'fecha_fin' => $M2_F->format('Y-m-d H:i:s'),
        ]);

        // Semana 3
        $M3 = Carbon::now()->subWeeks(2)->previous(Carbon::WEDNESDAY)->startOfDay();
        $M3_F = Carbon::now()->subWeeks(2)->previous(Carbon::WEDNESDAY)->endOfDay();
        $semanas->push([
            'nombre' => 'Semana 3',
            'fecha_inicio' => $M3->format('Y-m-d H:i:s'),
            'fecha_fin' => $M3_F->format('Y-m-d H:i:s'),
        ]);

        // Filtrado de tickets
        $tickets = Ticket::whereNotNull('fecha_cierre')
            ->whereNotNull('asignado')  // Aseguramos que el ticket esté asignado
            ->whereBetween('fecha_cierre', [$M3, $fechaActual])
            ->orderBy('fecha_cierre', 'desc')
            ->get();

        $ticketsPorAnalista = [];
        foreach ($tickets as $ticket) {
            $analista = $ticket->user->username;
            $fechaCierre = Carbon::parse($ticket->fecha_cierre);

            foreach ($semanas as $semana) {
                $inicio = Carbon::parse($semana['fecha_inicio'])->startOfDay();
                $fin = Carbon::parse($semana['fecha_fin'])->endOfDay();

                if ($fechaCierre->between($inicio, $fin)) {
                    $ticketsPorAnalista[$analista][$semana['nombre']][] = $ticket;
                }
            }
        }


        return view('reportes.index', compact('variable', 'Total', 'pendientes', 'all_user',
            'atenciones', 'user_pendiente', 'cantidada_pendiente', 'tipo', 'cantidad_tipo', 'primer_I', 'primer_R', 'user_fin',
            'cantidad_fin', 'finalizados', 'creados', 'diferencia_fin', 'sla_fin', 'slacount_fin', 'startDate', 'endDate','ticketsPorAnalista', 'semanas'));
    }

    public function vista_pendientes(Request $request)
    {
        $user = Auth::user();
        $permiso = RolPermiso::where('per_id', 5)->where('rol_id', Auth::user()->rol_id)->count();
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
        $all_user = User::all();
        $atenciones = Atencion::all();
        $user_id = Auth::user()->id;
        $observado = User::where('username', $request->username)->first();
        if (!$observado) {
            return redirect()->to('Asignar');
        }
        $tickets = Ticket::getListaAsignados($observado->id);
        $analistas = User::getAnalistas();
        $text = "Pendientes";
        return view('reportes.detalle', compact('tickets', 'analistas', 'all_user', 'atenciones', 'observado','text'));
    }

    public function vista_finalizados(Request $request)
    {
        $user = Auth::user();
        $permiso = RolPermiso::where('per_id', 5)->where('rol_id', Auth::user()->rol_id)->count();
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
        $all_user = User::all();
        $atenciones = Atencion::all();
        $user_id = Auth::user()->id;
        $observado = User::where('username', $request->username)->first();
        if (!$observado) {
            return redirect()->back();
        }
        $tickets = Ticket::whereIn('estado', ['F', 'T'])
            ->where('asignado', $observado->id)
            ->whereBetween('fecha_cierre', [$request->inicio, $request->fin]) // Rango de fechas
            ->get();
        $analistas = User::getAnalistas();
        $text = "Finalizados";
        return view('reportes.detalle', compact('tickets', 'analistas', 'all_user', 'atenciones', 'observado','text'));
    }

}
