<?php

namespace App\Http\Controllers;

use App\Models\Atencion;
use App\Models\Auditoria;
use App\Models\Permiso;
use App\Models\Rol;
use App\Models\RolPermiso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class RolPermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $variable='permisos-por-rol';
    protected $permiso='4';

    public function index()
    {
        $all_user = User::all();
        $atenciones = Atencion::all();
        $variable=$this->variable;
        // if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $permisos=Permiso::getLista();
        $roles=Rol::getLista();
        $usuarios=User::getLista();
        return view('configuracion.asignar2',compact('variable','permisos','roles','usuarios','all_user','atenciones'));

    }
    public function getProyectos($usuario)
    {
        $rol = RolPermiso::select('per_id')->where('rol_id',$usuario)->get()->ToArray();
        $permisos = null;
        $permisos_si = Permiso::wherein('id',$rol)->where('per_estado',1)->get();
        $permisos_no = Permiso::wherenotin('id',$rol)->where('per_estado',1)->get();
        foreach ($permisos_si as $permiso_si){
            $permisos [] =  [
                'id' => $permiso_si->id,
                'nombre' => $permiso_si->per_descripcion,
                'activado' => "activado"
            ];
        }
        foreach ($permisos_no as $permiso_no){
            $permisos [] =  [
                'id' => $permiso_no->id,
                'nombre' => $permiso_no->per_descripcion,
                'activado' => "desactivado"
            ];
        }
        return response()->json($permisos);
    }
    public function permisos_guardar(Request $request)
    {
//        dd($request);
        $variable=$this->variable;
        $permisos = Permiso::getLista();
        $rol = Rol::findOrFail($request->usuario);
        RolPermiso::where('rol_id',$request->usuario)->delete();
        foreach ($permisos as $permiso){
            if($request->{$permiso->id} && $request->{$permiso->id} == "on"){
                $rp = new RolPermiso();
                $rp->per_id = $permiso->id;
                $rp->rol_id = $request->usuario;
                $rp->save();
            }
        }
        Session::flash('flash_message', 'Roles Asignados correctamente a: '.$rol->rol_descripcion);
        Session::flash('alert-class', 'alert-success');
        return Redirect::to($variable);
    }


    public function ver_permiso_asignado(Request $request){
        $id_rol=$request->cbo_rol;
        $permisos_asignados=RolPermiso::ver_permiso_asignado($id_rol);
        $data=array();
        return view('configuracion.permisos_asignados',compact('permisos_asignados'));
    }
    public function ver_permiso_no_asignado(Request $request){
        $id_rol=$request->cbo_rol;
        $permisos_asignados=RolPermiso::ver_permiso_asignado($id_rol);

        $valores_permiso = array();

        $i = 1;
        foreach($permisos_asignados as $campo_permiso)
        {
            $valores_permiso[$i] = $campo_permiso->per_id;
            $i++;
        }

        $permiso_oculto = '';

        $permisos_sin_asignar = Permiso::ver_permisos_sin_asignar($valores_permiso,$permiso_oculto);

        return view('configuracion.permisos_no_asignados',compact('permisos_sin_asignar'));
    }
    public function asignar_permiso(Request $request){
        $id_rol=$request->cbo_rol;
        $id_permiso=$request->cbo_permisos_noasigandos;
        // $rol=User::findOrFail($id_rol);
        // // $rol=$request->rol_descripcion;
        // $rol->rol_estado=2;
        // $rol->save();

        $rolPermiso=new RolPermiso();
        $rolPermiso->per_id=$id_permiso;
        $rolPermiso->rol_id=$id_rol;
        $rolPermiso->save();

    }
    public function quitar_permiso(Request $request){
        $id_rol=$request->cbo_rol;
        $id_rol_permiso=$request->cbo_permisos_asigandos;
        // $rol=User::findOrFail($id_rol);
        // $rol->rol_estado=1;
        // $rol->save();
        $rolPermiso=RolPermiso::findOrFail($id_rol_permiso);

        RolPermiso::destroy($id_rol_permiso);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
