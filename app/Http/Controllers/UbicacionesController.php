<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Ubicaciones;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UbicacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $variable='ubicaciones';
    protected $permiso='5';
    

    public function index()
    { 
        $variable = $this->variable;
        $lista= Ubicaciones::getLista();

        return view('configuracion.ubicaciones',compact('variable','lista'));
    }  
    public function save_u(Request $request)
    {
        $variable = $this->variable;
        $lista= Ubicaciones::getLista();
        // Obtener los datos del formulario
        $ubicacion1 = $request->input('ubicacion1');
        $ubicacion2 = $request->input('ubicacion2');
        $ubicacion3 = $request->input('ubicacion3');

        $ubicacion = new Ubicaciones(); // Crear una nueva instancia del modelo Ubicacion
        $ubicacion->ubicacion_1 = $ubicacion1;
        $ubicacion->ubicacion_2 = $ubicacion2;
        $ubicacion->ubicacion_3 = $ubicacion3;
        $ubicacion->save(); // Guardar en la base de datos
        // Hacer algo con los datos, como guardarlos en la base de datos
        // Redirigir o devolver una respuesta JSON
        Session::flash('flash_message', 'Guardado Correctamente');
        Session::flash('alert-class', 'alert-success');
        return Redirect::to($this->variable); 
        // return view('configuracion.ubicaciones',compact('variable','lista'));
    }
    public function editar_ubi(Request $request,$id)
    {
        $variable = $this->variable;
        $Ubicaciones = Ubicaciones::findOrFail($id);
        
        // Actualiza los datos del proyecto con los nuevos valores del formulario
        $Ubicaciones->update($request->all());

        Session::flash('flash_message', 'Editado Correctamente');
        Session::flash('alert-class', 'alert-success');
        return Redirect::to($this->variable);
        
    }
    public function eliminar_ubi($id)
    {
        // Encuentra el proyecto por su ID
        // $proyecto = Proyectos::findOrFail($id);
        $Ubicaciones = Ubicaciones::findOrFail($id);
        $Ubicaciones->update(['estado' => 2]); // Suponiendo que el estado 2 representa "anulado"
        
        Session::flash('flash_message', 'Eliminado Correctamente');
        Session::flash('alert-class', 'alert-danger');
        return Redirect::to($this->variable);
       

    }
    
    
    
}