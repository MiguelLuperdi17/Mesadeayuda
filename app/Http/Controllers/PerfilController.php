<?php

namespace App\Http\Controllers;


use App\Models\Atencion;
use App\Models\RolPermiso;
use App\Models\User;
use App\Rules\ForbiddenWords;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $variable='perfil';
    protected $password='password';



    public function home()
    {
        $user = Auth::user();
        $permiso = RolPermiso::where('per_id',10)->where('rol_id',Auth::user()->rol_id)->count();
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
        $variable = $this->variable;
        // $paises = Paises::lista();
        // $ciudaddes = Ciudades::lista();
        $user = Auth::user();
        $user_id=$user->id;
        $lista = User::findOrFail($user_id);
        // $ciudaddes = Ciudades::lista();
        return view('configuracion.perfil',compact('variable','user_id', 'lista','all_user','atenciones'));
    }

    public function editar_perfil(Request $request)
    {
    //    dd( "sdfs");
        $variable = $this->variable;
        $user = Auth::user();
        $user_id=$user->id;
        $lista = User::findOrFail($user_id);
        $User = User::findOrFail($user_id);
        $User->name = $request->nombres;
        $User->surnames = $request->apellidos;
        // $User->username = $request->name;
        $User->movil = $request->celular;
        $User->email = $request->email;
        $User->password=bcrypt($request->password);
        //$User->change_pass = null;
        $User->save();
        return $User;
    }
    public function subir_imagen (Request $request)
    {
        $user = Auth::user();
        $user_id=$user->id;
        $user = User::findOrFail($user_id);
        if ($user->photo == NULL) {
            $file=$request->file('avatarFile');
            $nombre=rand().'_'.$file->getClientOriginalName();
            $user->photo=$nombre;

            $file->move(public_path().'/fotos_perfil',$nombre);
            $user->save();
        }
        else{

            $vehiculo = User::find($user_id);
            unlink(public_path('/fotos_perfil/'.$vehiculo -> photo));

            // $img_antigua=Storage::disk('public')->delete('/fotos_perfil'.$vehiculo->photo);
            // $vehiculo -> delete();

            $user = User::findOrFail($user_id);
            $file=$request->file('avatarFile');
            $nombre=rand().'_'.$file->getClientOriginalName();
            $user->photo=$nombre;

            $file->move(public_path().'/fotos_perfil',$nombre);
            $user->save();
        }
        $dir="/fotos_perfil/";
        $foto_actual=$dir.$user->photo;

        return $foto_actual;


    }

    public function password()
    {
        $all_user = User::all();
        $atenciones = Atencion::all();
        $variable = $this->variable;
        $user = Auth::user();
        $user_id=$user->id;
        $lista = User::findOrFail($user_id);
        return view('configuracion.password',compact('variable','user_id', 'lista','all_user','atenciones'));
    }
    public function password_change()
    {
        $all_user = User::all();
        $atenciones = Atencion::all();
        $variable = $this->variable;
        $user = Auth::user();
        $user_id=$user->id;
        $lista = User::findOrFail($user_id);
        return view('configuracion.password_change',compact('variable','user_id', 'lista','all_user','atenciones'));
    }
    public function actualizar_password(Request $request)
    {

        $variable = $this->variable;
        $user = Auth::user();
        $this->validate($request, [
            'password' => [
                'required',
                'string',
                'min:12',             // Al menos 12 caracteres
                'regex:/[a-z]/',     // Al menos una letra minúscula
                'regex:/[A-Z]/',     // Al menos una letra mayúscula
                'regex:/[0-9]/',     // Al menos un número
                'regex:/[@$!%*?&]/', // Al menos un carácter especial
                new ForbiddenWords(), // Regla personalizada para evitar palabras prohibidas
            ],
            'passwordConfirm' => [
                'required',
                'string',
                'min:12',             // Al menos 12 caracteres
                'regex:/[a-z]/',     // Al menos una letra minúscula
                'regex:/[A-Z]/',     // Al menos una letra mayúscula
                'regex:/[0-9]/',     // Al menos un número
                'regex:/[@$!%*?&]/', // Al menos un carácter especial
                'same:password',     // Asegura que la confirmación coincida con la contraseña
            ],
        ]);
        $datosUsuario = request()->except(['_token','_method']);
        $id=Auth::user()->id;
        $usuario=User::findOrFail($id);
        $usuario->change_pass = Carbon::now()->format('Y-m-d H:i:s');
        $usuario->password=bcrypt($request->password);
        $usuario->save();

        return response()->json(['code'=>200,'success' => 'Actualizado Correctamente'],200);

        // return response()->json(['code'=>200,'success' => 'Hooray'],200);
    }

    public function psswrd(Request $request)
    {

        $variable = $this->variable;
        $user = Auth::user();
        $this->validate($request, [
            "password" => "required",
            "passwordConfirm" => "required|same:password",
        ]);
        $datosUsuario = request()->except(['_token','_method']);
        $id=Auth::user()->id;
        $usuario=User::findOrFail($id);
        $usuario->password=bcrypt($request->password);
        $usuario->save();

        return response()->json(['code'=>200,'success' => 'Actualizado Correctamente'],200);

        // return response()->json(['code'=>200,'success' => 'Hooray'],200);
    }


}
