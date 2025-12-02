<?php

namespace App\Http\Controllers;

use App\Models\Atencion;
use App\Models\RolPermiso;
use App\Models\Solucion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SolucionController extends Controller
{
    public function vistaAdmin()
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
        $atenciones = Atencion::all();
        $all_user = User::all();
        $soluciones = Solucion::getLista();
        return view('base_conocimiento.soluciones', compact('atenciones','all_user','soluciones','variable'));
    }

    public function listar(Request $request, $atencion_id = null)
    {
        DB::statement("SET SQL_MODE=''");

        $buscar = $request->buscar;

        $query = Solucion::select(
                'soluciones.*',
                DB::raw('COUNT(sa.id) as tickets'),
                'a.nombre as atencion_nombre'
            )
            ->leftJoin('solucion_atencion as sa', 'sa.solucion_id', '=', 'soluciones.id')
            ->leftJoin('atenciones as a', 'a.id', '=', 'soluciones.atencion_id')
            ->groupBy('soluciones.id');

        if (!empty($atencion_id)) {
            $query->where('soluciones.atencion_id', $atencion_id);
        }

        if (!empty($buscar)) {
            $query->where(function ($q) use ($buscar) {
                $q->where('soluciones.titulo', 'LIKE', "%$buscar%")
                ->orWhere('soluciones.descripcion', 'LIKE', "%$buscar%");
            });
        }

        return response()->json($query->get());
    }



    public function cambiarEstado(Request $request, $id)
    {
        $sol = Solucion::findOrFail($id);
        $sol->estado = $request->estado;
        $sol->save();

        return response()->json(['ok' => true]);
    }

    public function edit($id)
    {
        return Solucion::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|numeric'
        ]);

        $sol = Solucion::findOrFail($id);
        $sol->titulo = $request->titulo;
        $sol->descripcion = $request->descripcion;
        $sol->estado = $request->estado;
        $sol->save();
        return response()->json(['success' => true]);
    }


}
