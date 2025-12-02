<?php

namespace App\Http\Controllers;

use App\Models\Atencion;
use App\Models\Auditoria;
use App\Models\Locations_centers;
use App\Models\Rol;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Arr;
use App\Models\RolPermiso;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $variable='usuarios';

    protected $permiso='1';

    public function index()
    {
        $user = Auth::user();
        $permiso = RolPermiso::where('per_id',33)->where('rol_id',$user->rol_id)->count();
        $last_change_date = Carbon::createFromFormat('Y-m-d H:i:s', ($user->change_pass != null ? $user->change_pass : $user->created_at ));
        $diffInDays = Carbon::now()->diffInDays($last_change_date);
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
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        //$lista=User::paginate('50');
        $lista=$all_user;
        $logueo=$user->name;
        $id_logeo=$user->id;
        return view('configuracion.usuarios',compact('lista','variable','logueo','id_logeo','all_user','atenciones'));
    }
    public function perfil_user()
    {
        $variable=$this->variable;
        $logueo=Auth::user()->name;
        $id_logeo=Auth::user()->id;

        $id=Auth::user()->id;
        $rol_id =Auth::user()->rol_id;

        $usuarios=User::findOrFail($id);
        return view('configuracion.perfil',compact('rol_id','id','usuarios','variable','logueo','id_logeo'));
    }

    public function perfil_edit(Request $request)
    {
        $variable=$this->variable;
        $perfil='perfil';
        $datosUsuario = request()->except(['_token','_method']);
        $id=Auth::user()->id;

        $usuario=User::findOrFail($id);
        // $usuario->email=$request->email;
        $usuario->password=bcrypt($request->password);
        // $usuario->rol_id=$request->rol_id;
        if ($request->foto==null) {
            $usuario->save();
        }else{
            $usuario->foto=$request->file('foto')->store('uploads','public');
            $usuario->save();
        }

        return Redirect::to($perfil)->with('mensaje','Usuario Editado Correctamente');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $variable=$this->variable;

        // return view('usuarios.nuevo',compact('variable','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar_user(Request $request)
    {
        $variable=$this->variable;
        // if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
//        dd($request);
        $usuario=new User;
        $usuario->name=$request->name;
        $usuario->surnames=$request->surnames;
        $usuario->username=$request->username;
        $usuario->email=$request->email;
        $usuario->movil=$request->movil;
        $usuario->id_sede = 1;
        $usuario->password=bcrypt($request->password);
        $usuario->rol_id= $request->rol_id;
        $usuario->photo= "default.jpg";
        $usuario->save();

        // if ($usuario->rol_id == 2) {
        //     // Iterar sobre los valores de 1 a 10, excepto el 6, y guardar un RolPermiso para cada uno
        //     for ($i = 1; $i <= 10; $i++) {
        //         if ($i != 6) {
        //             $rolPermiso = new RolPermiso();
        //             $rolPermiso->per_id = $i;
        //             $rolPermiso->rol_id = $usuario->id;
        //             $rolPermiso->save();
        //         }
        //     }
        // }

        Session::flash('flash_message', 'Usuario Creado Correctamente');
        Session::flash('alert-class', 'alert-success');
        return Redirect::to($this->variable);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $variable=$this->variable;
        // $usuarios=User::findOrFail($id);

        // return view('usuarios.editar',compact('usuarios','variable','roles') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function editar_user(Request $request,$id)
    {
        $variable=$this->variable;
        // if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        $datosUsuario = request()->except(['_token','_method']);


        // if($request->hasFile('foto')){
        //     $usuario=User::findOrFail($id);
        //     Storage::delete('public/'.$usuario->foto);
        //     $datosUsuario['foto']=$request->file('foto')->store('uploads','public');
        // }
        // User::where('id','=',$id)->update($datosUsuario);
        $usuario=User::findOrFail($id);
        $usuario->name=$request->name;
        $usuario->surnames=$request->surnames;
        $usuario->username=$request->username;
        $usuario->email=$request->email;
        $usuario->movil=$request->movil;
        $usuario->id_sede = 1;
        $usuario->password=bcrypt($request->password);
        $usuario->rol_id= $request->rol_id;
        if ( $usuario->photo="") {
            $usuario->photo= "default.jpg";
        }
        $usuario->save();

        Session::flash('flash_message', 'Usuario Editado Correctamente');
        Session::flash('alert-class', 'alert-success');
        return Redirect::to($this->variable);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function eliminar_user(Request $request,$id)
    {
        $variable=$this->variable;
        User::destroy($id);
        $usuarioPermiso = RolPermiso::get()->where('rol_id' ,$id );
        $usuarioPermiso->destroy();

        Session::flash('flash_message', 'Usuario Eliminado Correctamente');
        Session::flash('alert-class', 'alert-danger');
        return Redirect::to($this->variable);
    }


}

