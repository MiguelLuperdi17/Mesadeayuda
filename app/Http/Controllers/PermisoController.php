<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use App\Models\Permiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $variable='permisos';
    // protected $permiso='3';

    public function index()
    {
        $variable=$this->variable;
        // if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $permisos=Permiso::getLista();
        return view('configuracion.permisos',compact('permisos','variable'));
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
     * @param  \App\Models\Permiso  $Permiso
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permiso  $Permiso
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permiso  $Permiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $variable=$this->variable;
        // if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $datosPermisos = request()->except(['_token','_method']);
        Permiso::where('id','=',$id)->update($datosPermisos);

        
        return Redirect::to($this->variable)->with('mensaje','Permiso Editado Correctamente'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permiso  $Permiso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Permiso::destroy($id);
        // return redirect('permisos');
    }
}
