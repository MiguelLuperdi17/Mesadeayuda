<?php

namespace App\Http\Controllers;

use App\Models\Adjunto;
use App\Models\Aprobacion;
use App\Models\Atencion;
use App\Models\Comentario;
use App\Models\Material;
use App\Models\RolPermiso;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Equipo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use App\Models\Solucion;
use App\Models\SolucionAtencion;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class TicketController extends Controller
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

        $tickets = Ticket::getListaUser($user->id);
        //        foreach ($tickets as $ticket) {
        //            dd($ticket->id, $ticket->adjuntos);
        //        }
        return view('ticket.index', compact('variable', 'tickets', 'all_user', 'atenciones'));
    }
    public function create(Request $request)
    {
        $temp = Ticket::getCantidad_crear();
        $cant_archivos = 1;
        $inicio = 176575 + $temp;
        $ticket = new Ticket();
        $ticket->codigo = $inicio;
        $ticket->atencion_id = $request->id_categoria;
        $ticket->detalle = $request->requerimiento;
        $ticket->fecha_creacion = Carbon::now()->format('Y-m-d H:i:s');
        $ticket->user_id = $request->user ? $request->user : Auth::user()->id;
        $ticket->save();

        $user_temp = Auth::user()->username;
        $mail_temp = Auth::user()->mail;

        //$data = [
        //    'username' => $user_temp,
        //    'subject' => 'Registro de ticket N° '.$ticket->codigo,
        //    'text_1' => 'Se creó el ticket N° '.$ticket->codigo.' del usuario: '. $user_temp,
        //    'text_2' => $ticket->detalle,
        //    'correo' => $mail_temp,
        //];
        $data = [
            'subject' => 'Se registró un nuevo ticket N.º ' . $ticket->codigo,
            'titulo' => 'Le informamos que su ticket con número ' . $ticket->codigo . ', ha sido registrado e informado al equipo de soporte:',
            'contenido' => "
                <strong>Detalle del ticket N.º: {$ticket->codigo}</strong><br>
                \"{$ticket->detalle}\"
            ",
            'enlace' => 'http://mesadeayudalaredo.com/MisTickets',
            'enlace_texto' => 'Ver ticket',
            'footer' => 'Si tiene alguna duda o desea agregar información adicional, puede responder directamente desde el portal.',
            'firma' => 'Gracias por su atención.<br>— Equipo de Sistemas',
            'correo_destino' => $ticket->usercreador->email,
            'logo' => asset('recursos/logo2.png'), // opcional
        ];
        Mail::to($ticket->usercreador->email)->queue(new TestEmail($data));

        $request->validate([
            'archivos.*' => 'required|mimes:pdf,doc,docx,xls,xlsx|max:10240', // Max 10MB
        ]);

        // Procesar y guardar cada archivo
        if ($request->hasFile('archivos')) {
            foreach ($request->file('archivos') as $archivo) {
                // Guardar el archivo en la carpeta de almacenamiento
                //                $nombreArchivo = $archivo->getClientOriginalName();
                $extension = pathinfo($archivo->getClientOriginalName(), PATHINFO_EXTENSION);
                $nombreArchivo = $inicio . "-" . $cant_archivos . "." . $extension;
                //                dd($nombreArchivo);
                $archivo->move(public_path('archivos'), $nombreArchivo);
                $adjunto = new Adjunto();
                $adjunto->ticket_id = $ticket->id;
                $adjunto->detalle = $nombreArchivo;
                $adjunto->save();
                //                $ticket->{"archivo_" . $cant_archivos} = $nombreArchivo;
                $cant_archivos++;
                // Aquí podrías guardar información adicional en la base de datos si es necesario
            }
            return redirect()->back()->with('success', 'Archivos subidos correctamente.');
        }
        return redirect()->back()->with('error', 'No se han subido archivos.');
    }

    public function obtenerDato(Request $request)
    {
        //xd
        $id = $request->input('user'); // Obtén el valor seleccionado en el select
        $ticket = User::FindOrFail($id);
        $url = 'http://172.16.2.110/testglpi/ListaEquipos.php?usuario=' . $ticket->username;
        $response = Http::get($url);
        $data = $response->json();
        $statusCode = $response->status();

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'subcategorias' => $data, // Aquí 'atributo' es el campo que quieres devolver
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró el dato',
            ]);
        }
    }

    public function vista_asignar(Request $request)
    {
        $user = Auth::user();
        $permiso = RolPermiso::where('per_id', 2)->where('rol_id', $user->rol_id)->count();
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
        $variable = "Hola";
        $tickets = Ticket::getListaPendiente();
        $i = Atencion::select('id')->where('tipo', 'I')->get();
        $lista = array_map('strval', array_column($i->ToArray(), 'id'));
        $lista_aprobacion = ['5', '83', '77'];
        $autorizadores = User::getAutorizadores();
        $analistas = User::getAnalistas();
        //dd($atenciones,$autorizadores);
        return view('ticket.asignar', compact('variable', 'tickets', 'autorizadores', 'analistas', 'atenciones', 'all_user', 'lista', 'lista_aprobacion'));
    }

    public function anular_ticket(Request $request)
    {
        $comentario = new Comentario();
        $comentario->ticket_id = $request->ticket_id;
        $comentario->comentario = $request->comentario;
        $comentario->fecha = Carbon::now()->format('Y-m-d H:i:s');
        $comentario->user_id = Auth::user()->id;
        $comentario->save();

        $ticket = Ticket::FindOrFail($request->ticket_id);
        $ticket->estado = 'X';
        $ticket->save();

        $data = [
            'subject' => 'Se Anuló el ticket N.º ' . $ticket->codigo,
            'titulo' => 'Le informamos que su ticket con número ' . $ticket->codigo . ', ha sido anulado por el motivo descrito a continuación:',
            'contenido' => "
                <strong>Detalle del ticket N.º: {$ticket->codigo}</strong><br>
                La anulación se realizó por \"{$comentario->comentario}\"
            ",
            'enlace' => 'http://mesadeayudalaredo.com/MisTickets',
            'enlace_texto' => 'Ver ticket',
            'footer' => 'Si tiene alguna duda o desea agregar información adicional, puede responder directamente desde el portal.',
            'firma' => 'Gracias por su atención.<br>— Equipo de Sistemas',
            'correo_destino' => $ticket->usercreador->email,
            'logo' => asset('recursos/logo2.png'), // opcional
        ];
        Mail::to($ticket->usercreador->email)->queue(new TestEmail($data));
        return redirect()->back();
    }

    public function cerrar_ticket(Request $request)
    {
        $ticket = Ticket::FindOrFail($request->ticket_id);
        $ticket->estado = 'F';
        $ticket->fecha_cierre = Carbon::now()->format('Y-m-d H:i:s');
        $ticket->save();

        $data = [
            'subject' => 'Se Finalizó la atención del ticket N.º ' . $ticket->codigo,
            'titulo' => 'Le informamos que su ticket con número ' . $ticket->codigo . ', ha sido finalizado:',
            'contenido' => "
                <strong>Detalle del ticket N.º: {$ticket->codigo}</strong><br>
                La atención se realizó por \"{$ticket->user->username}\"
            ",
            'enlace' => 'http://mesadeayudalaredo.com/MisTickets',
            'enlace_texto' => 'Ver ticket',
            'footer' => 'Si tiene alguna duda o desea agregar información adicional, puede responder directamente desde el portal.',
            'firma' => 'Gracias por su atención.<br>— Equipo de Sistemas',
            'correo_destino' => $ticket->usercreador->email,
            'logo' => asset('recursos/logo2.png'), // opcional
        ];
        Mail::to($ticket->usercreador->email)->queue(new TestEmail($data));

        return redirect()->back();
    }

    public function cerrar_incidentes(Request $request)
    {
        $ticket = Ticket::FindOrFail($request->ticket_id);
        $ticket->estado = 'F';
        $ticket->fecha_cierre = Carbon::now()->format('Y-m-d H:i:s');
        $ticket->save();
        if($request->solucion_existente){
            $solucion = Solucion::FindOrFail($request->solucion_existente);
        }else{
            $solucion = new Solucion();
            $solucion->titulo = $request->titulo;
            $solucion->descripcion = $request->detalle;
            $solucion->fecha_creacion = Carbon::now()->format('Y-m-d H:i:s');
            $solucion->fecha_actualizacion = Carbon::now()->format('Y-m-d H:i:s');
            $solucion->atencion_id = $ticket->atencion_id;
            $solucion->save();
        }
        $sa = new SolucionAtencion();
        $sa->ticket_id = $ticket->id;
        $sa->solucion_id = $solucion->id;
        $sa->equipo_id = $request->equipo_id;
        $sa->save();



        return redirect()->back();
    }

    public function asignar_ticket(Request $request)
    {
        //dd("hola");
        $ticket = Ticket::FindOrFail($request->ticket_id);
        $ticket->estado = 'A';
        $ticket->asignado = $request->analista;
        //$ticket->atencion_id = $request->atencion;
        $request->impacto ? $ticket->impacto = $request->impacto : $ticket->impacto = null;
        $request->urgencia ? $ticket->urgencia = $request->urgencia : $ticket->urgencia = null;
        $ticket->fecha_asignacion = Carbon::now()->format('Y-m-d H:i:s');
        $ticket->save();

        $data = [
            'username' => Auth::user()->username,
            'subject' => 'Asignación de ticket N° ' . $ticket->codigo,
            'text_1' => 'Se asignó el ticket N° ' . $ticket->codigo . ' del usuario: ' . $ticket->usercreador->username . 'al analista: ' . $ticket->user->username,
            'text_2' => $ticket->detalle,
            'text_3' => 'Puede revisar el detalle completo del ticket accediendo al portal de la mesa de ayuda: <a href="http://mesadeayudalaredo.com/MisTickets">http://mesadeayudalaredo.com/MisTickets</a><br><br>
                        Si tiene alguna duda o desea agregar información adicional, puede responder directamente desde el portal.<br><br>Gracias por su atención.',
            'correo' => $ticket->usercreador->email,
        ];
        Mail::to('miguel.luperdi@agroindustriallaredo.com')->queue(new TestEmail($data));

        return redirect()->back();
    }

    public function reasignar_ticket(Request $request)
    {
        $ticket = Ticket::FindOrFail($request->ticket_id);
        $ticket->asignado = $request->analista;
        $ticket->fecha_asignacion = Carbon::now()->format('Y-m-d H:i:s');
        $ticket->save();

        $data = [
            'subject' => 'Se reasignó el ticket N.º ' . $ticket->codigo,
            'titulo' => 'Le informamos que su ticket con número ' . $ticket->codigo . ', ha sido reasignado:',
            'contenido' => "
                <strong>Detalle del ticket N.º: {$ticket->codigo}</strong><br>
                La atención se reasignó a \"{$ticket->user->username}\"
            ",
            'enlace' => 'http://mesadeayudalaredo.com/MisTickets',
            'enlace_texto' => 'Ver ticket',
            'footer' => 'Si tiene alguna duda o desea agregar información adicional, puede responder directamente desde el portal.',
            'firma' => 'Gracias por su atención.<br>— Equipo de Sistemas',
            'correo_destino' => $ticket->usercreador->email,
            'logo' => asset('recursos/logo2.png'), // opcional
        ];
        Mail::to($ticket->usercreador->email)->queue(new TestEmail($data));

        return redirect()->back();
    }

    public function rechazar_ticket(Request $request)
    {
        $user_id = Auth::user()->id;
        $aprobacion = Aprobacion::where('ticket_id', $request->ticket_id)->where('user_id', $user_id)->first();
        $aprobacion->fecha_aprobacion = Carbon::now()->format('Y-m-d H:i:s');
        $aprobacion->estado = "R";
        $aprobacion->save();

        $comentario = new Comentario();
        $comentario->ticket_id = $request->ticket_id;
        $comentario->comentario = $request->comentario;
        $comentario->fecha = Carbon::now()->format('Y-m-d H:i:s');
        $comentario->user_id = Auth::user()->id;
        $comentario->save();

        return redirect()->back();
    }

    public function aprobar_ticket(Request $request)
    {
        $user_id = Auth::user()->id;
        $aprobacion = Aprobacion::where('ticket_id', $request->ticket_id)->where('user_id', $user_id)->first();
        $aprobacion->fecha_aprobacion = Carbon::now()->format('Y-m-d H:i:s');
        $aprobacion->estado = "A";
        $aprobacion->save();
        return redirect()->back();
    }

    public function vista_solucionar(Request $request)
    {
        $user = Auth::user();
        $permiso = RolPermiso::where('per_id', 3)->where('rol_id', Auth::user()->rol_id)->count();
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
        $tickets = Ticket::getListaAsignados($user_id);
        return view('ticket.solucionar', compact('tickets', 'all_user', 'atenciones'));
    }

    public function vista_seguimiento(Request $request)
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
        $tickets = Ticket::getListaSeguimiento();
        $analistas = User::getAnalistas();
        return view('ticket.seguimiento', compact('tickets', 'analistas', 'all_user', 'atenciones'));
    }
    public function vista_consulta(Request $request)
    {
        /*
        $us='CSERRATO';
        $url='http://172.16.2.110/testglpi/ListaEquipos.php?usuario='.$us;
        $response = Http::get($url);
        $data = $response->json();
        $statusCode = $response->status();
        if ($response->successful()) {
            // Procesar los datos
            dd($data);
        } else {
            // Manejar error
            dd('Error en la API');
        }*/
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
        $tickets = Ticket::where('estado', 'F')->get();
        $analistas = User::getAnalistas();
        return view('ticket.consulta', compact('tickets', 'analistas', 'all_user', 'atenciones'));
    }
    public function vista_aprobar(Request $request)
    {
        $user = Auth::user();
        $permiso = RolPermiso::where('per_id', 9)->where('rol_id', Auth::user()->rol_id)->count();
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
        $variable = Auth::user()->id;
        //$tickets = Ticket::getListaAprobar($variable);
        $pendientes = Aprobacion::select('ticket_id')->where('user_id', $user->id)
            ->wherenull('fecha_aprobacion')->get();
        $tickets = Ticket::wherein('id', $pendientes->ToArray())->get();
        $analistas = User::getAnalistas();
        return view('ticket.aprobar', compact('tickets', 'variable', 'analistas', 'all_user', 'atenciones'));
    }

    public function vista_material(Request $request)
    {
        $user = Auth::user();
        $permiso = RolPermiso::where('per_id', 8)->where('rol_id', Auth::user()->rol_id)->count();
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
        $variable = Auth::user()->id;
        $materiales = Material::getLista();
        return view('ticket.material', compact('materiales', 'variable', 'all_user', 'atenciones'));
    }

    public function crear_material(Request $request)
    {
        $comentario = new Comentario();
        $comentario->ticket_id = $request->ticket_id;
        $comentario->comentario = $request->comentario;
        $comentario->fecha = Carbon::now()->format('Y-m-d H:i:s');
        $comentario->user_id = Auth::user()->id;
        $comentario->save();

        $ticket = Ticket::FindOrFail($request->ticket_id);
        $ticket->estado = 'X';
        $ticket->save();

        return redirect("Materiale");
    }

    public function updateTicket(Request $request)
    {
        $ticketId = $request->input('ticket_id');
        $atencionId = $request->input('atencion_id');
        $ticket = Ticket::find($ticketId);
        if ($ticket) {
            $ticket->atencion_id = $atencionId;
            $ticket->save();
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Ticket no encontrado']);
        }
    }
    public function prueba_api(Request $request)
    {
        // --- Paso 1: Iniciar sesión ---
        $urlLogin = 'http://172.16.2.110/apirest.php/initSession';
        $userToken = 'vUpDDVCqjrYP63sfblMPVZNCmEfvn7IYcxIzk6ai';
        $appToken = 'PyJNhlxm1rqlOtf415FSBEZd2x8Iw7JdmtCkOjAy';

        $responseLogin = Http::withHeaders([
            'App-Token' => $appToken
        ])->get($urlLogin, [
            'user_token' => $userToken
        ]);

        if (!$responseLogin->successful()) {
            return response()->json([
                'error' => 'No se pudo iniciar sesión con la API.',
                'status' => $responseLogin->status(),
                'body' => $responseLogin->body()
            ], $responseLogin->status());
        }

        $sessionToken = $responseLogin->json()['session_token'];

        // --- Paso 2: Obtener información de computadoras ---
        $urlComputers = 'http://172.16.2.110/apirest.php/Computer/?expand_dropdowns=true&range=0-99999';

        $responseComputers = Http::withHeaders([
            'App-Token' => $appToken,
            'Session-Token' => $sessionToken
        ])->get($urlComputers);

        if (!$responseComputers->successful()) {
            return response()->json([
                'error' => 'No se pudo obtener la información de computadoras.',
                'status' => $responseComputers->status(),
                'body' => $responseComputers->body()
            ], $responseComputers->status());
        }

        $computers = $responseComputers->json();

        //dd($computers[81],$computers[1]);

        $nuevos = 0;
        $actualizados = 0;
        $inactivos = 0;
        $omitidos = 0;

        foreach ($computers as $computer) {
            $fechaRegistro = Carbon::parse($computer['date_creation'])->format('Y-m-d H:i:s');
            $estadoActual = strtolower($computer['states_id']); // 'operativo' o no
            $equipo = Equipo::where('id_link', $computer['id'])->first();

            if ($equipo) {
                // CASO 1: equipo existente, ahora no operativo
                if ($estadoActual !== 'operativo' && $equipo->estado != 0) {
                    $equipo->estado = 0;
                    $equipo->fecha_actualizacion = now();
                    $equipo->save();
                    $inactivos++;
                    continue;
                }

                // CASO 2: equipo existente, operativo
                if ($estadoActual === 'operativo') {
                    // Si la fecha no cambió, se omite
                    if ($equipo->fecha_registro == $fechaRegistro && $equipo->estado == 1) {
                        $omitidos++;
                        continue;
                    }

                    // Actualizar datos
                    $equipo->fill([
                        'nombre_equipo' => $computer['name'],
                        'serial' => $computer['serial'] ?? 'Sin nombre',
                        'tipo' => $computer['computertypes_id'],
                        'modelo' => $computer['computermodels_id'],
                        'marca' => $computer['manufacturers_id'],
                        'usuario' => $computer['users_id'],
                        'fecha_actualizacion' => now(),
                        'fecha_registro' => $fechaRegistro,
                        'estado' => 1,
                    ]);

                    $equipo->save();
                    $actualizados++;
                }
            } else {
                // CASO 3: equipo nuevo, solo crear si es operativo
                if ($estadoActual === 'operativo') {
                    Equipo::create([
                        'nombre_equipo' => $computer['name'],
                        'serial' => $computer['serial'] ?? 'Sin nombre',
                        'tipo' => $computer['computertypes_id'],
                        'modelo' => $computer['computermodels_id'],
                        'marca' => $computer['manufacturers_id'],
                        'usuario' => $computer['users_id'],
                        'fecha_creacion' => now(),
                        'fecha_actualizacion' => now(),
                        'fecha_registro' => $fechaRegistro,
                        'id_link' => $computer['id'],
                        'estado' => 1,
                    ]);
                    $nuevos++;
                }
            }
        }

        return response()->json([
            'message' => 'Sincronización completada correctamente.',
            'nuevos' => $nuevos,
            'actualizados' => $actualizados,
            'inactivos' => $inactivos,
            'omitidos' => $omitidos,
        ]);
    }

    public function prueba_api_detalle($id)
    {
        // --- Paso 1: Iniciar sesión ---
        $urlLogin = 'http://172.16.2.110/apirest.php/initSession';
        $userToken = 'vUpDDVCqjrYP63sfblMPVZNCmEfvn7IYcxIzk6ai';
        $appToken = 'PyJNhlxm1rqlOtf415FSBEZd2x8Iw7JdmtCkOjAy';

        $responseLogin = Http::withHeaders([
            'App-Token' => $appToken
        ])->get($urlLogin, [
            'user_token' => $userToken
        ]);

        if (!$responseLogin->successful()) {
            return response()->json([
                'error' => 'No se pudo iniciar sesión con la API.',
                'status' => $responseLogin->status(),
                'body' => $responseLogin->body()
            ], $responseLogin->status());
        }

        $sessionToken = $responseLogin->json()['session_token'];
        $user_prueba = 'Cpiscoya';
        // --- Paso 2: Obtener información de computadoras ---
        $urlComputers = 'http://172.16.2.110/apirest.php/search/User?criteria[0][field]=1&criteria[0][searchtype]=contains&forcedisplay[0]=1&forcedisplay[1]=2&forcedisplay[2]=9&criteria[0][value]=' . $user_prueba;

        $responseComputers = Http::withHeaders([
            'App-Token' => $appToken,
            'Session-Token' => $sessionToken
        ])->get($urlComputers);

        if (!$responseComputers->successful()) {
            return response()->json([
                'error' => 'No se pudo obtener la información de computadoras.',
                'status' => $responseComputers->status(),
                'body' => $responseComputers->body()
            ], $responseComputers->status());
        }

        // Puedes retornar directamente los datos
        dd($responseComputers->json());

        return response()->json([
            'computadoras' => $responseComputers->json()
        ]);
    }
}
