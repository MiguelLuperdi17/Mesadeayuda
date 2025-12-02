<?php

namespace App\Http\Controllers;

use App\Models\Atencion;
use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\RolPermiso;
use App\Models\Solucion;
use App\Models\SolucionAtencion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EquipoController extends Controller
{
    public function vista_bc_equipos()
    {
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

        // Traer solo equipos realmente usados en soluciones
        $ids_equipos = SolucionAtencion::whereNotNull('equipo_id')
            ->pluck('equipo_id')
            ->unique()
            ->toArray();

        $equipos = Equipo::whereIn('id', $ids_equipos)->get();

        return view('base_conocimiento.equipos', compact(
            'variable', 'all_user', 'equipos', 'atenciones'
        ));
    }

    public function getSolucionesPorEquipo($equipo_id)
    {
        $soluciones = DB::table('soluciones as s')
            ->join('solucion_atencion as sa', 'sa.solucion_id', '=', 's.id')
            ->join('tickets as t', 't.id', '=', 'sa.ticket_id')
            ->select(
                's.id',
                's.titulo',
                's.descripcion',
                't.codigo as ticket_codigo',
                't.detalle as ticket_detalle'
            )
            ->where('sa.equipo_id', $equipo_id)
            ->orderBy('s.id', 'desc')
            ->get();

        return response()->json($soluciones);
    }
    public function getSolucionesPorAtencion($atencion_id)
    {
        $soluciones = Solucion::where('atencion_id', $atencion_id)
            ->select('id', 'titulo', 'descripcion')
            ->orderBy('fecha_creacion', 'desc')
            ->get();
        return response()->json($soluciones);
    }

    public function vista_baseconocimiento()
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

        return view('base_conocimiento.index', compact('variable', 'all_user', 'atenciones'));
    }
    public function getEquiposUsuario($user)
    {
        // Retorna los equipos vinculados al usuario
        $equipos = Equipo::where('usuario', $user)->get();
        return response()->json($equipos);
    }

    public function getDetalleSolucion($id)
    {
        $sol = Solucion::find($id);
        return response()->json($sol);
    }

    public function obtenerSolucionesPorAtencion($atencion_id)
    {
        $soluciones = DB::table('soluciones as s')
            ->join('solucion_atencion as sa', 'sa.solucion_id', '=', 's.id')
            ->join('tickets as t', 't.id', '=', 'sa.ticket_id')
            ->select(
                's.id',
                's.titulo',
                's.descripcion',
                DB::raw('COUNT(sa.id) as tickets')
            )
            ->where('t.atencion_id', $atencion_id)
            ->groupBy('s.id', 's.titulo', 's.descripcion')
            ->orderBy('s.id', 'desc')
            ->get();

        return response()->json($soluciones);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/ckeditor'), $fileName);

            $url = asset('uploads/ckeditor/' . $fileName);

            return response()->json([
                'url' => $url
            ]);
        }
    }
}
