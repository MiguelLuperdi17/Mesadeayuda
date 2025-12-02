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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use App\Models\Proveedor;
use App\Models\ProveedorAdjunto;
use App\Models\ProveedorTicket;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class ProveedorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $permiso = RolPermiso::where('per_id',14)->where('rol_id',$user->rol_id)->count();
        $last_change_date = Carbon::createFromFormat('Y-m-d H:i:s', ($user->change_pass != null ? $user->change_pass : $user->created_at ));
        $diffInDays = Carbon::now()->diffInDays($last_change_date);
        $variable = $user->id;
        if($permiso == 0){
            return redirect()->back();
        }
        if($diffInDays > 90){
            Session::flash('flash_message', 'Debe actualizar su contraseña');
            Session::flash('alert-class', 'alert-danger');
            return redirect('password_change');
        }
        $all_user = User::all();
        $atenciones = Atencion::all();
        $proveedores = User::getListaProveedor();
        if($user->rol_id == 6){
            $tickets = ProveedorTicket::getListaProveedor($user->id);
        }else{
            $tickets = ProveedorTicket::getLista();
        }
        foreach($tickets->where('estado',1) as $temp){
            $fecha_cierre = Carbon::now()->startOfDay()->format('Y-m-d H:i:s');
            //$fecha_asignacion = Carbon::parse($temp->fecha_creacion)->endOfDay();
            $fecha_asignacion = Carbon::parse($temp->fecha_creacion);
            //dd($fecha_asignacion);
            $workingDays = 0;
            $currentDate = $fecha_asignacion->copy();
            while ($currentDate <= $fecha_cierre) {
                if (!in_array($currentDate->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY])) {
                    $workingDays++;
                }
                $currentDate->addDay();
            }
            if($temp->sla_id < $workingDays){
                $temp->estado = 3;
                $temp->save();
            }
        }
        return view('proveedores.index',compact('variable','tickets','all_user','atenciones','user','proveedores'));
    }

    public function vista_proveedores()
    {
        $user = Auth::user();
        $permiso = RolPermiso::where('per_id',1)->where('rol_id',$user->rol_id)->count();
        $last_change_date = Carbon::createFromFormat('Y-m-d H:i:s', ($user->change_pass != null ? $user->change_pass : $user->created_at ));
        $diffInDays = Carbon::now()->diffInDays($last_change_date);
        $variable = $user->id;
        if($permiso == 0){
            return redirect()->back();
        }
        if($diffInDays > 90){
            Session::flash('flash_message', 'Debe actualizar su contraseña');
            Session::flash('alert-class', 'alert-danger');
            return redirect('password_change');
        }

        $all_user = User::all();
        $atenciones = Atencion::all();
        $proveedores = Proveedor::getLista();

        return view('proveedores.proveedor',compact('variable','proveedores','all_user','atenciones'));
    }

    public function crear_ticket_prov(Request $request){
        //dd($request);
        $temp = ProveedorTicket::getCantidadProveedor($request->proveedor);
        //dd($temp);
        $cant_archivos = 1;
        $ticket = new ProveedorTicket();
        $ticket->correlativo = 1 + $temp;
        $ticket->proveedor_id = $request->proveedor;
        $ticket->descripcion = $request->requerimiento;
        $ticket->sla_id = $request->categoria;
        $ticket->estado = 1;
        $ticket->fecha_creacion = Carbon::now()->format('Y-m-d H:i:s');
        $ticket->user_id = Auth::user()->id;
        $ticket->save();

        $data = [
            'username' => Auth::user()->username,
            'subject' => 'Registro de ticket N° '.$ticket->codigo,
            'text_1' => 'Se creó el ticket N° '.$ticket->codigo.' del usuario: '. Auth::user()->username,
            'text_2' => $ticket->detalle,
            'correo' => Auth::user()->email,
        ];
        Mail::to('miguel.luperdi@agroindustriallaredo.com')->queue(new TestEmail($data));
//        Mail::to('recipient@example.com')->queue(new MyMailable());
//        Mail::to('miguel.luperdi@agroindustriallaredo.com')->send(new TestEmail($data));

        $request->validate([
            'archivos.*' => 'required|mimes:pdf,doc,docx,xls,xlsx|max:10240', // Max 10MB
        ]);

        // Procesar y guardar cada archivo
        if ($request->hasFile('archivos')) {
            foreach ($request->file('archivos') as $archivo) {
                $extension = pathinfo($archivo->getClientOriginalName(), PATHINFO_EXTENSION);
                $nombreArchivo = "Prov".$ticket->proveedor_id."-".$ticket->correlativo."-".$cant_archivos.".".$extension;
                $archivo->move(public_path('archivos'), $nombreArchivo);
                $adjunto = new ProveedorAdjunto();
                $adjunto->ticket_id = $ticket->id;
                $adjunto->detalle = $nombreArchivo;
                $adjunto->save();
                $cant_archivos++;
            }
            return redirect()->back()->with('success', 'Archivos subidos correctamente.');
        }
        return redirect()->back()->with('error', 'No se han subido archivos.');
    }


    public function finalizar_ticket_prov(Request $request){
        $ticket = ProveedorTicket::FindOrFail($request->ticket_id);
        $ticket->estado = 2;
        $ticket->fecha_final = Carbon::createFromFormat('d/m/y H:i', $request->fecha);
        $ticket->save();
        $cant_archivos = $ticket->adjuntos->count() + 1;
        // Procesar y guardar cada archivo
        if ($request->hasFile('archivos')) {
            foreach ($request->file('archivos') as $archivo) {
                // Guardar el archivo en la carpeta de almacenamiento
//                $nombreArchivo = $archivo->getClientOriginalName();
                $extension = pathinfo($archivo->getClientOriginalName(), PATHINFO_EXTENSION);
                $nombreArchivo = "ProvResp".$ticket->proveedor_id."-".$ticket->correlativo."-".$cant_archivos.".".$extension;
//                dd($nombreArchivo);
                $archivo->move(public_path('archivos'), $nombreArchivo);
                $adjunto = new ProveedorAdjunto();
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

    public function crear_proveedor(Request $request){
        dd($request);
        return redirect()->back()->with('success', 'Proveedor creado correctamente.');
    }

    public function vista_proveedores_reporte()
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
        // consultas
        $all_user = User::all();
        $atenciones = Atencion::all();
        $Total = ProveedorTicket::getCantidad();
        $pendientes = ProveedorTicket::getListaPendientesReporte();
        $creados = ProveedorTicket::getCreadosSemanal();
        $cerrados = ProveedorTicket::getCerradosSemanal();
        $resueltos = ProveedorTicket::where('estado',2)->get();
        $user_pendiente = [];
        $nivel_pendiente = [];

        //div 1 y 2
        foreach($pendientes as $pendiente){
            $username = $pendiente->user->username;
            $user_pendiente[$username] = $username;
            if (!isset($cantidada_pendiente[$username])) {
                $cantidada_pendiente[$username] = 0;
            }
            $cantidada_pendiente[$username]++;
        }
        //div 3
        foreach($pendientes as $pendiente){
            $username = "Nivel ".$pendiente->sla_id;
            $categoria_pendiente[$username] = $username;
            if (!isset($cant_cat_pendiente[$username])) {
                $cant_cat_pendiente[$username] = 0;
            }
            $cant_cat_pendiente[$username]++;
        }
        $total_dias = 0;
        foreach($resueltos as $resuelto){
            $fechaCreacion = Carbon::parse($resuelto->fecha_creacion);
            $fechaFinal = Carbon::parse($resuelto->fecha_final);
            $diff = $fechaCreacion->diffInDays($fechaFinal);
            $total_dias = $total_dias + $diff;
        }
        $promedio = ($total_dias / $resueltos->count())* 8;
        $tickets = ProveedorTicket::getLista();
        foreach($tickets->where('estado',1) as $temp){
            $fecha_cierre = Carbon::now()->startOfDay()->format('Y-m-d H:i:s');
            //$fecha_asignacion = Carbon::parse($temp->fecha_creacion)->endOfDay();
            $fecha_asignacion = Carbon::parse($temp->fecha_creacion);
            //dd($fecha_asignacion);
            $workingDays = 0;
            $currentDate = $fecha_asignacion->copy();
            while ($currentDate <= $fecha_cierre) {
                if (!in_array($currentDate->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY])) {
                    $workingDays++;
                }
                $currentDate->addDay();
            }
            if($temp->sla_id < $workingDays){
                $temp->estado = 3;
                $temp->save();
            }
        }

        return view('proveedores.reporte', compact('variable', 'Total', 'all_user','atenciones','pendientes','creados','cerrados','user_pendiente',
        'cantidada_pendiente','categoria_pendiente','cant_cat_pendiente','promedio'));
    }

    public function pendientes_proveedores(Request $request)
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
        $tipo = $request->tipo;
        if($request->tipo == "analista"){
            $observado = User::where('username', $request->username)->first();
            $tickets = ProveedorTicket::where('user_id',$observado->id)->where('estado','!=',2)->get();
        }elseif($request->tipo == "sla"){
            $observado = $request->username;
            $tickets = ProveedorTicket::where('proveedor_id',1)->where('estado','!=',2)->get();
        }
        else{
            $observado = $request->username;
            $tickets = ProveedorTicket::where('proveedor_id',1)->where('estado',2)->get();
        }
        return view('proveedores.detalle_reporte',compact('variable','tickets','all_user','atenciones','tipo','observado'));
    }
}
