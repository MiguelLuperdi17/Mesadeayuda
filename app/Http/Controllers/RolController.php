<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Rol;
use App\Models\RolPermiso;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $variable='roles';
    protected $permiso='2';
    
    public function index()
    {
        $variable=$this->variable;
        // if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        // $roles=Rol::getLista();
        $roles=Rol::paginate('10');
        $rol_permisos=RolPermiso::getLista();
        return view('configuracion.roles',compact('roles','variable','rol_permisos'));

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
    public function crear_rol(Request $request)
    {
        $variable=$this->variable;

        // if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        
        $rol=new Rol;
        $rol->rol_descripcion=$request->rol_descripcion;
        $rol->rol_estado=1;
        $rol->save();

        // $fecha_hora = horaactual();
        Session::flash('flash_message', 'Guardado Correctamente');
        Session::flash('alert-class', 'alert-success');
        return Redirect::to($this->variable);


        // return Redirect::to($this->variable)->with('mensaje','Rol Creado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rol  $Rol
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rol  $Rol
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rol  $Rol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $variable=$this->variable;
        // if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        
        $datosRoles = request()->except(['_token','_method']);
        Rol::where('id','=',$id)->update($datosRoles);

        // $fecha_hora = horaactual();
        Session::flash('flash_message', 'Editado Correctamente');
        Session::flash('alert-class', 'alert-success');
        return Redirect::to($this->variable);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rol  $Rol
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $variable=$this->variable;
        // Encuentra el cliente por su ID
        $Roles = Rol::findOrFail($id);
        $rolPermisos = RolPermiso::get()->where('rol_id' ,$id);
        $usuarios = User::get()->where('rol_id' ,$id);

        if ($usuarios->isEmpty()) {
            foreach ($rolPermisos as $rp) {
                $rp->delete();
            }
            $Roles->delete();
            Session::flash('flash_message', 'Eliminado Correctamente');
            Session::flash('alert-class', 'alert-danger');
            return Redirect::to($this->variable);
        } else {
            Session::flash('flash_message', 'Este Rol esta asociado a Usuario');
            Session::flash('alert-class', 'alert-warning');
            return Redirect::to($this->variable);
        }
    }
}
