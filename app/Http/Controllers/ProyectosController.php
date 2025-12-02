<?php

namespace App\Http\Controllers;

use App\Models\Adjunto;
use App\Models\AdjuntoHito;
use App\Models\Atencion;
use App\Models\Ccosto;
use App\Models\Hito;
use App\Models\ComentarioHito;
use App\Models\HistorialHito;
use App\Models\Proyecto;
use App\Models\RolPermiso;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProyectosController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $permiso = RolPermiso::where('per_id', 1)->where('rol_id', $user->rol_id)->count();
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

        $analistas = User::getAnalistas();

        $proyectos = Proyecto::getLista();

        //$ext = HistorialHito::getProyectos_id();

        foreach ($proyectos as $proyecto) {
            //if($proyecto->id==13){
            //    dd($proyecto->ext);
            //}
            $hitos = Hito::where('estado', '<', 3)->where('proyecto_id', $proyecto->id)->count();
            if ($hitos == 0) {
                $proyecto->estado = 6;
            } else {
                $hitos_v = Hito::where('estado', 1)->where('proyecto_id', $proyecto->id)->count();
                if ($hitos_v > 0) {
                    $max_hito = Hito::findOrFail($proyecto->hitos->max('id'));
                    if ($max_hito->estado == 1) {
                        $proyecto->estado = 4;
                    } else {
                        $proyecto->estado = 3;
                    }
                }
            }
            $proyecto->save();
        }


        return view('proyectos.index', compact('variable', 'proyectos', 'user', 'all_user', 'atenciones', 'analistas'));
    }

    public function create(Request $request)
    {
        //dd($request);
        $correlativo = Proyecto::where('correlativo', '>', 202500)->count();
        $cant_archivos = 1;
        $proyecto = new Proyecto();
        $proyecto->titulo = $request->título;
        $proyecto->id_categoria = $request->id_categoria;
        $proyecto->id_responsable = $request->id_responsable;
        $proyecto->descripcion = $request->requerimiento;
        $proyecto->correlativo = 202501 + $correlativo;
        $proyecto->fecha_creacion = Carbon::now()->format('Y-m-d H:i:s');
        $proyecto->save();
        foreach ($request->hitos as $indice => $hito) {
            $h = new Hito();
            $h->nombre = $hito;
            $h->proyecto_id = $proyecto->id;
            $h->fecha_inicio = $request->fecha_inicio[$indice];
            $h->fecha_fin = $request->fecha_fin[$indice];
            $h->save();
        }
        $request->validate([
            'archivos.*' => 'required|mimes:pdf,doc,docx,xls,xlsx|max:10240', // Max 10MB
        ]);
        // Procesar y guardar cada archivo
        if ($request->hasFile('archivos')) {
            foreach ($request->file('archivos') as $archivo) {
                // Guardar el archivo en la carpeta de almacenamiento
                //                $nombreArchivo = $archivo->getClientOriginalName();
                $extension = pathinfo($archivo->getClientOriginalName(), PATHINFO_EXTENSION);
                $nombreArchivo = $proyecto->id . "-" . $cant_archivos . "." . $extension;
                //                dd($nombreArchivo);
                $archivo->move(public_path('archivos'), $nombreArchivo);
                $adjunto = new AdjuntoHito();
                $adjunto->proyecto_id = $proyecto->id;
                $adjunto->detalle = $nombreArchivo;
                $adjunto->save();
                //                $ticket->{"archivo_" . $cant_archivos} = $nombreArchivo;
                $cant_archivos++;
                // Aquí podrías guardar información adicional en la base de datos si es necesario
            }
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function programa_hitos($id)
    {
        $user = Auth::user();
        $permiso = RolPermiso::where('per_id', 1)->where('rol_id', $user->rol_id)->count();
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

        $analistas = User::getAnalistas();
        $proyecto = Proyecto::FindOrFail($id);
        $hitos = Hito::getListaProyecto($id);
        foreach ($hitos as $hito) {
            if ($hito->fecha_fin < Carbon::now()->format('Y-m-d H:i:s')) {
                if ($hito->estado != 3) {
                    $hito->estado = 1;
                    $hito->save();
                }
            }
        }
        //dd($hitos);
        return view('proyectos.hitos', compact('variable', 'proyecto', 'hitos', 'all_user', 'atenciones', 'analistas', 'user'));
    }

    public function aprobar_proyecto($id)
    {
        $user_id = Auth::user()->id;
        $proyecto = Proyecto::FindOrFail($id);
        $proyecto->aprobacion = 1;
        $proyecto->fecha_aprobacion = Carbon::now()->format('Y-m-d H:i:s');
        $proyecto->save();
        return redirect()->back();
    }

    public function rechazar_proyecto(Request $request)
    {
        $user_id = Auth::user()->id;
        $proyecto = Proyecto::FindOrFail($request->id);
        $proyecto->aprobacion = 2;
        $proyecto->estado = 2;
        $proyecto->comentario = $request->comentario;
        $proyecto->fecha_aprobacion = Carbon::now()->format('Y-m-d H:i:s');
        $proyecto->save();
        return redirect()->back();
    }

    public function fechas_hitos(Request $request)
    {
        $proyectoId = $request->input('proyecto_id');
        $proyecto = Proyecto::FindOrfail($proyectoId);
        $proyecto->estado = 0;
        $proyecto->save();
        $hitos = $request->input('hitos');
        $userId = Auth::user()->id;
        $currentTime = Carbon::now()->format('Y-m-d H:i:s');
        foreach ($hitos as $hito) {
            $hitoId = $hito['id'];
            $fechaInicio = $hito['fecha_inicio'] ?? null;
            $fechaFin = $hito['fecha_fin'] ?? null;
            if ($fechaInicio || $fechaFin) {
                //dd($hitoId, $fechaInicio,$fechaFin,$request);
                $hh = new HistorialHito();
                $hh->hito_id = $hitoId;
                $hh->cambio = $currentTime;
                $hh->user_id = $userId;
                $hitoActual = Hito::findOrFail($hitoId);
                if ($fechaInicio && $fechaFin) {
                    $hh->fecha_inicio = Carbon::createFromFormat('d/m/Y', $fechaInicio);
                    $hh->fecha_fin = Carbon::createFromFormat('d/m/Y', $fechaFin);
                    $hitoActual->fecha_inicio =  Carbon::createFromFormat('d/m/Y', $fechaInicio);
                    $hitoActual->fecha_fin =  Carbon::createFromFormat('d/m/Y', $fechaFin);
                } elseif ($fechaInicio && !$fechaFin) {
                    $hh->fecha_inicio = Carbon::createFromFormat('d/m/Y', $fechaInicio);
                    $hh->fecha_fin = $hitoActual->fecha_fin;
                    $hitoActual->fecha_inicio =  Carbon::createFromFormat('d/m/Y', $fechaInicio);
                } elseif ($fechaFin && !$fechaInicio) {
                    $hh->fecha_inicio = $hitoActual->fecha_inicio;
                    $hh->fecha_fin = Carbon::createFromFormat('d/m/Y', $fechaFin);
                    $hitoActual->fecha_fin =  Carbon::createFromFormat('d/m/Y', $fechaFin);
                }
                $hitoActual->estado = 0;
                $hitoActual->save();
                $hh->proyecto_id = $proyectoId;
                $hh->comentario = $request->input('comentario');
                $hh->save();
            }
        }

        return redirect()->back()->with('success', 'Datos actualizados correctamente.');
    }


    public function finalizar_hito(Request $request)
    {
        $user_id = Auth::user()->id;
        $hito = Hito::FindOrFail($request->hito_id);
        $hito->estado = 3;
        $hito->save();
        return redirect()->back();
    }

    public function MisComentarios_hito(Request $request)
    {
        $comentarios = ComentarioHito::getListaProyecto($_POST['proyecto_id']);
        return json_encode([$comentarios]);
    }
    public function comentario(Request $request)
    {
        $comentario = new ComentarioHito();
        $comentario->proyecto_id = $request->proyecto_id;
        $comentario->comentario = $request->comentario;
        $comentario->fecha = Carbon::now()->format('Y-m-d H:i:s');
        $comentario->user_id = Auth::user()->id;
        $comentario->save();

        return redirect()->back()->with('success', 'Se creó el comentario solicitado.');
    }
    public function reportes_proyectos()
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
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        ///
        //////
        $today = Carbon::today();
        $nextWeek = Carbon::today()->addWeek();
        $all_user = User::all();
        $atenciones = Atencion::all();
        $Total = Proyecto::getCantidad();
        $pend_aprob = Proyecto::where('aprobacion', 0)->count();
        $hitos_ext = Hito::where('fecha_fin', '<', $today)->count();

        // Hitos vencidos hasta hoy
        $hitosVencidos = Hito::where('fecha_fin', '<', $today)
            ->whereHas('proyecto', function ($query) {
                $query->whereNotNull('id_responsable');
            })
            ->with(['proyecto.responsable'])
            ->get()
            ->groupBy(fn($hito) => $hito->proyecto->responsable->username ?? 'Sin responsable');

        // Hitos que vencen en los próximos 7 días
        $hitosPorVencer = Hito::whereBetween('fecha_fin', [$today, $nextWeek])
            ->whereHas('proyecto', function ($query) {
                $query->whereNotNull('id_responsable');
            })
            ->with(['proyecto.responsable'])
            ->get()
            ->groupBy(fn($hito) => $hito->proyecto->responsable->username ?? 'Sin responsable');


        $proyectos = Proyecto::with(['hitos', 'responsable'])
            ->whereHas('responsable') // solo proyectos con responsable asignado
            ->get();

        $resumen = [];

        foreach ($proyectos as $proyecto) {
            $username = $proyecto->responsable->username ?? 'Sin responsable';

            if (!isset($resumen[$username])) {
                $resumen[$username] = [
                    'username' => $username,
                    'vencidos' => 0,
                    'por_vencer' => 0,
                ];
            }

            foreach ($proyecto->hitos as $hito) {
                if ($hito->fecha_fin < $today && $hito->estado != 3) {
                    $resumen[$username]['vencidos']++;
                } elseif ($hito->fecha_fin >= $today && $hito->fecha_fin <= $nextWeek) {
                    $resumen[$username]['por_vencer']++;
                }
            }
        }

        $categorias = Proyecto::select('id_categoria')
            ->selectRaw('COUNT(id) as total')
            ->groupBy('id_categoria')
            ->get();
        $cat_total = [];
        $cat_desc = [];
        foreach ($categorias as $categoria) {
            $cat_total[] = $categoria->total;
            if ($categoria->id_categoria == 1) {
                $cat_desc[] = 'Desarrollo';
            } elseif ($categoria->id_categoria == 2) {
                $cat_desc[] = 'Infraestructura';
            } else {
                $cat_desc[] = 'Mantenimiento';
            }
        }
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
        $periodo = Carbon::now()->translatedFormat('F-Y');
        $p_costos = Ccosto::getListaPendiente($periodo);
        //xd
        $proyec = Proyecto::getLista();
        $desc_meses = [];
        $monto_meses = [];
        $desc_meses[] = 'Vencido';
        $monto_meses[] = $proyec->wherein('estado', [1, 4, 5])->count();
        $desc_meses[] = 'En Proceso';
        $monto_meses[] = $proyec->where('estado', 0)->count() - $pend_aprob;
        $desc_meses[] = 'Por aprobar';
        $monto_meses[] = $pend_aprob;
        $desc_meses[] = 'Rechazado';
        $monto_meses[] = $proyec->where('estado', 2)->count();
        $desc_meses[] = 'Finalizado';
        $monto_meses[] = '4';
        //$desc_meses []= 'Ene-2025';
        //$monto_meses []= '9831.67';
        //CECO
        $ceco_d = [];
        $ceco_c = [];
        $asignados = Proyecto::whereIn('estado', [0, 1, 2, 4, 5])
            ->select('id_responsable')
            ->selectRaw('COUNT(id) as total')
            ->groupBy('id_responsable')
            ->get();

        $ceco_c = [];
        $ceco_d = [];
        foreach ($asignados as $asignado) {
            $ceco_c[] = $asignado->total;
            $ceco_d[] = $asignado->user->username;
        }
        //Año
        $año_d = [];
        $año_c = [];
        $año_d[] = '2024';
        $año_c[] = '12805.07';
        //$año_d[]= '2025';
        //$año_c[]= '9831.67';

        //foreach ($detalle_meses as $detalle) {
        //    $monto_meses []= $detalle->total;
        //    $desc_meses []= $detalle->mes;
        //}
        //dd($resumen);


        $proyectos_resp = Proyecto::with(['hitos', 'responsable'])
            ->whereHas('responsable')
            ->get();

        // Creamos un resumen agrupado por responsable
        $resum = [];

        foreach ($proyectos_resp as $proyect) {
            $username = $proyect->responsable->username ?? 'Sin responsable';

            if (!isset($resum[$username])) {
                $resum[$username] = [
                    'username' => $username,
                    'total_hitos' => 0,
                    'hitos_completados' => 0,
                ];
            }

            $totalHitos = $proyect->hitos->count();
            $completados = $proyect->hitos->where('estado', 3)->count(); // ajusta el estado si usas otro valor

            $resum[$username]['total_hitos'] += $totalHitos;
            $resum[$username]['hitos_completados'] += $completados;
        }

        // Calcular el % de avance
        $reporte = collect($resum)->map(function ($data) {
            $avance = $data['total_hitos'] > 0
                ? round(($data['hitos_completados'] / $data['total_hitos']) * 100, 2)
                : 0;

            return [
                'username' => $data['username'],
                'total_hitos' => $data['total_hitos'],
                'hitos_completados' => $data['hitos_completados'],
                'avance_porcentaje' => $avance
            ];
        })->values();


        $proyectos_resp = Proyecto::with(['hitos', 'responsable'])
            ->whereHas('responsable')
            ->get();

        $proyectos_resp = Proyecto::with(['hitos', 'responsable'])
            ->whereHas('responsable')
            ->get();

        $resumenProyectos = [];

        foreach ($proyectos_resp as $proyecto) {
            $username = $proyecto->responsable->username ?? 'Sin responsable';

            if (!isset($resumenProyectos[$username])) {
                $resumenProyectos[$username] = [
                    'username' => $username,
                    'total_proyectos' => 0,
                    'proyectos_pendientes' => 0,
                    'proyectos_finalizados' => 0,
                ];
            }

            $totalHitos = $proyecto->hitos->count();
            $completados = $proyecto->hitos->where('estado', 3)->count();

            $resumenProyectos[$username]['total_proyectos'] += 1;

            if ($totalHitos > 0 && $completados === $totalHitos) {
                $resumenProyectos[$username]['proyectos_finalizados'] += 1;
            } else {
                $resumenProyectos[$username]['proyectos_pendientes'] += 1;
            }
        }

        $reporteProyectos = collect($resumenProyectos)->map(function ($data) {
            $avance = $data['total_proyectos'] > 0
                ? round(($data['proyectos_finalizados'] / $data['total_proyectos']) * 100, 2)
                : 0;

            return [
                'username' => $data['username'],
                'total_proyectos' => $data['total_proyectos'],
                'proyectos_pendientes' => $data['proyectos_pendientes'],
                'proyectos_finalizados' => $data['proyectos_finalizados'],
                'avance_porcentaje' => $avance
            ];
        })->values();

        return view('proyectos.reportes', compact(
            'variable',
            'Total',
            'pendientes',
            'all_user',
            'atenciones',
            'user_pendiente',
            'cantidada_pendiente',
            'tipo',
            'cantidad_tipo',
            'primer_I',
            'primer_R',
            'user_fin',
            'cantidad_fin',
            'finalizados',
            'creados',
            'diferencia_fin',
            'meses',
            'p_costos',
            'monto_meses',
            'desc_meses',
            'ceco_d',
            'ceco_c',
            'año_d',
            'año_c',
            'cat_total',
            'cat_desc',
            'pend_aprob',
            'hitos_ext',
            'resumen',
            'reporte',
            'reporteProyectos'
        ));
    }
    public function pendientes_proyecto(Request $request)
    {
        $today = Carbon::today();
        $nextWeek = Carbon::today()->addWeek();
        $user = Auth::user();
        $permiso = RolPermiso::where('per_id', 1)->where('rol_id', $user->rol_id)->count();
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

        $analistas = User::getAnalistas();

        //$hitosVencidos = Hito::where('fecha_fin', '<', $today)
        //    ->whereHas('proyecto.responsable', function ($query) use ($request) {
        //        $query->where('username', $request->username);
        //    })
        //    ->with(['proyecto.responsable'])
        //    ->get();

        $proyectos = Proyecto::whereHas('responsable', function ($query) use ($request) {
            $query->where('username', $request->username);
        })
            ->whereHas('hitos', function ($query) use ($today) {
                $query->where('fecha_fin', '<', $today);
            })
            ->with(['hitos' => function ($query) use ($today) {
                $query->where('fecha_fin', '<', $today);
            }, 'responsable'])
            ->get();
        $analista = $request->username;
        //dd($proyectos);
        //xd
        //$proyectos = Proyecto::getLista();
        return view('proyectos.vencidos', compact('variable', 'proyectos', 'user', 'all_user', 'atenciones', 'analistas', 'analista'));
    }
}
