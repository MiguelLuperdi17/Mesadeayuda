<?php

namespace App\Http\Controllers;

use App\Imports\HtmlImport;
use App\Models\Inventario;
use App\Models\Materiales;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class MaterialesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $variable = 'materiales';

    protected $permiso = '3';

//    public function index()
//    {
//        $variable = $this->variable;
////        $lista= Materiales::getLista();
//        $lista = Materiales::limit(100)->get();
//        return view('configuracion.materiales',compact('variable','lista'));
//
//    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Materiales::select(['id','codigo', 'descripcion', 'sub_familia', 'nro_parte', 'desc_larga',
                'familia', 'um', 'grupo', 'costo_unitario', 'estado']);

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    // Puedes agregar acciones personalizadas aquí
                    $btn = '<form method="POST">
                                                            <input type="hidden" value="{{csrf_token()}}" name="_token"
                                                                   id="token">
                                                            <a data-toggle="modal" title="Editar"
                                                               data-target="#Editar">
                                                                <input onclick="cargarDatos('.$row->id.')"
                                                                       type="button" class="btn btn-primary btn-sm" id="Editar"
                                                                       value="Editar">
                                                            </a>
                                                        </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson(); // Devuelve los datos en formato JSON para DataTables
        }

        return view('configuracion.materiales');
    }

    public function material_editar(Request $request)
    {
        $material = Materiales::FindOrFail($_POST['id_material']);
        return json_encode([$material]);
    }

//    public function editar_material(Request $request,$id)
//    {
//        dd("hola",$id, $request);
//        $material = Materiales::FindOrFail($_POST['id_material']);
//        return json_encode([$material]);
//    }

    public function import_excel(Request $request)
    {
        $import = new HtmlImport;

        try {
            Excel::import($import, $request->file('excelFile'));

            // Obtener filas que no se pudieron importar
            $failedRows = $import->getFailedRows();

            // if (!empty($failedRows)) {
            //     // Si hay filas fallidas, lanzar una excepción de validación con un mensaje personalizado
            //     throw ValidationException::withMessages(['excelFile' => 'Algunas filas no se pudieron importar correctamente.']);
            // }

            // Si la importación fue exitosa, mostrar un mensaje de éxito
            Session::flash('flash_message', 'El archivo Excel ha sido importado correctamente.');
            Session::flash('alert-class', 'alert-success');
            return Redirect::to($this->variable);
        } catch (ValidationException $e) {
            // dd($e->getMessage(), $e->errors());
            // Capturar la excepción de validación y redirigir con los errores
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function guardar_mat(Request $request)
    {
        // Valida los datos del formulario
        $validatedData = $request->validate([
            'codigo' => 'required|string|unique:materiales', // Agrega la regla unique
            'nro_parte' => 'required|string',
            'marca' => 'required|string',
            'descripcion' => 'required|string',
            'desc_larga' => 'required|string',
            'um' => 'required|string',
            'familia' => 'required|string',
            'sub_familia' => 'required|string',
            'grupo' => 'required|string',
            'costo_unitario' => 'required|string',
        ]);

        // Guarda el material en la base de datos
        Materiales::create($validatedData);
        Session::flash('flash_message', 'Guardado Correctamente');
        Session::flash('alert-class', 'alert-success');
        return Redirect::to($this->variable);
        // Redirige a una página de éxito o a donde desees
    }

    public function actualizarMaterial(Request $request, $id)
    {
        // Encuentra el material por su ID
        $material = Materiales::findOrFail($id);
        $material->nro_parte = $request->nro_parte;
        $material->marca = $request->marca;
        $material->descripcion = $request->descripcion;
        $material->desc_larga = $request->desc_larga;
        $material->um = $request->um;
        $material->familia = $request->familia;
        $material->sub_familia = $request->sub_familia;
        $material->grupo = $request->grupo;
        $material->save();
//        dd($material);
//        // Valida los datos del formulario
//        $validatedData = $request->validate([
//            'codigo' => 'required|integer',
//            'nro_parte' => 'required|integer',
//            'marca' => 'required|string',
//            'descripcion' => 'required|string',
//            'desc_larga' => 'required|string',
//            'um' => 'required|string',
//            'familia' => 'required|string',
//            'sub_familia' => 'required|string',
//            'grupo' => 'required|string',
//        ]);
        // Actualiza los datos del material con los nuevos valores del formulario
//        $material->update($validatedData);

        // Redirige a donde desees después de actualizar el material
        Session::flash('flash_message', 'Editado Correctamente');
        Session::flash('alert-class', 'alert-success');
        return Redirect::to($this->variable);
    }

    public function anular_m($id)
    {
        // Encuentra el proyecto por su ID
        // $proyecto = Proyectos::findOrFail($id);
        $Materiales = Materiales::findOrFail($id);

        $Materiales->update(['estado' => 2]); // Suponiendo que el estado 2 representa "anulado"

        Session::flash('flash_message', 'Anulado Correctamente');
        Session::flash('alert-class', 'alert-danger');
        return Redirect::to($this->variable);

    }


}
