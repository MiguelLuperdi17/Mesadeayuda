<?php

namespace App\Http\Controllers;

use App\Imports\HtmlImport;
use App\Models\Clientes;
use App\Models\Cotizaciones;
use App\Models\Guias;
use App\Models\Link;
use App\Models\Materiales;
use App\Models\Proyectos;
use App\Models\SubCotizaciones;
use App\Models\SubGuias;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DOMDocument;
use DOMText;
use DOMXPath;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CotizacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $variable='cotizaciones';
    protected $variable_2='despacho';

    protected $permiso='10';

    public function index()
    {
        $variable = $this->variable;
        $lista= Cotizaciones::getLista();
        // $lista_sub= SubCotizaciones::getLista();
        $lista_cliente= Clientes::getLista();
        $lista_guias_filtro= Guias::getListaFiltro();
        $lista_proyecto= Proyectos::getLista();
        $lista_guias= Guias::getLista();
        $frx1_6_texts =[];
        $frx1_25_texts = [];
        return view('cotizaciones.index',compact('variable','lista','frx1_6_texts','frx1_25_texts','lista_cliente','lista_guias','lista_guias_filtro'));
    }
    public function link_guia(Request $request)
    {
        if ($request->guias != "0") {
            $convertir = intval($request->guias);
            $id_cotizacion = $request->id_cotizacion;

            // Obtener las guías y cotizaciones relacionadas
            $tabla_guias = SubGuias::where('id_guia', $convertir)->get();
            $tabla_cotizaciones = SubCotizaciones::where('id_cotizacion', $id_cotizacion)->get();

            // Verificar si ambas colecciones tienen la misma cantidad de registros
            if ($tabla_guias->count() <= $tabla_cotizaciones->count()) {
                // Inicializar la variable para almacenar la suma de despachos
                $totalDespachos = 0;
                foreach ($tabla_guias as $indice => $guia) {
                    // Verificar si los códigos son iguales
                    if ($guia->codigo === $tabla_cotizaciones[$indice]->codigo) {
                        // Verificar si la cantidad de la guía es menor o igual a la cantidad de la cotización
                        if ($guia->cantidad <= $tabla_cotizaciones[$indice]->cantidad) {
                            // Obtener el registro de subcotización actual
                            $subCotizacion = SubCotizaciones::find($tabla_cotizaciones[$indice]->id);

                            // Verificar si ya hay un valor en despachado y sumarlo con el nuevo
                            if ($subCotizacion->despachado != null) {
                                $nuevaCantidadDespachada = $subCotizacion->despachado + $guia->cantidad;
                            } else {
                                $nuevaCantidadDespachada = $guia->cantidad;
                            }

                            // Verificar si la nueva cantidad despachada supera la cantidad de la subcotización
                            if ($nuevaCantidadDespachada <= $tabla_cotizaciones[$indice]->cantidad) {
                                // Actualizar el valor de despachado en la subcotización
                                $subCotizacion->despachado = $nuevaCantidadDespachada;
                                $subCotizacion->save();

                                // Incrementar la suma total de despachos
                                $totalDespachos += $guia->cantidad;
                                if ($subCotizacion->despachado == $subCotizacion->cantidad) {
                                    $subCotizacion2 = SubCotizaciones::find($tabla_cotizaciones[$indice]->id);
                                    $subCotizacion2->estado = 2;
                                    $subCotizacion2->save();
                                }
                                date_default_timezone_set('America/Lima');
                                $fecha_y_hora_actual = date("Y-m-d H:i:s");
                                $id_logeo=Auth::user()->id;

                                Link::create([
                                    'estado' => 1,
                                    'id_cotizacion' => $id_cotizacion,
                                    'id_guia' => $convertir,
                                    'cantidad' => $guia->cantidad,
                                    'date_subida' => $fecha_y_hora_actual,
                                    'id_sub_cotizacion' => $subCotizacion->id,
                                    'id_sub_guia' => $guia->id,
                                    'id_user' => $id_logeo,

                                ]);

                            } else {
                                Session::flash('flash_message', 'La cantidad despachada supera la cantidad de la cotización');
                                Session::flash('alert-class', 'alert-warning');
                                return Redirect::to($this->variable);
                            }
                        } else {
                            Session::flash('flash_message', 'La cantidad de la guía supera la cantidad de la cotización');
                            Session::flash('alert-class', 'alert-warning');
                            return Redirect::to($this->variable);
                        }
                    } else {
                        Session::flash('flash_message', 'Los códigos de las guías no coinciden con los de la cotización');
                        Session::flash('alert-class', 'alert-warning');
                        return Redirect::to($this->variable);
                    }
                }

                // Actualizar la columna 'avance' en la tabla de cotizaciones con la suma de todos los despachos
                $cotizacion = Cotizaciones::find($id_cotizacion);
                $cotizacion->avance = $cotizacion->avance + $totalDespachos;
                $cotizacion->save();

                $subtCotizaciones = SubCotizaciones::where('id_cotizacion', $id_cotizacion)->get();

                // Verifica si todas las subtCotizaciones tienen estado 2
                $todasEstado2 = $subtCotizaciones->every(function ($subtCotizacion) {
                    return $subtCotizacion->estado == 2;
                });

                // Si todas las subtCotizaciones tienen estado 2, actualiza el estado de la cotización a 2
                if ($todasEstado2) {
                    Cotizaciones::where('id', $id_cotizacion)->update(['estado' => 2]);
                }
                // Insertar el enlace entre la guía y la cotización
                // date_default_timezone_set('America/Lima');
                // $fecha_y_hora_actual = date("Y-m-d H:i:s");
                // Link::create([
                //     'estado' => 1,
                //     'id_cotizacion' => $id_cotizacion,
                //     'id_guia' => $convertir,
                //     'cantidad' => $totalDespachos,
                //     'date_subida' => $fecha_y_hora_actual,
                // ]);
                Guias::where('id', $convertir)->update(['estado' => 2,'link' =>$id_cotizacion]);



                Session::flash('flash_message', 'Linkeado Correctamente');
                Session::flash('alert-class', 'alert-success');
                return Redirect::to($this->variable);
            } else {
                Session::flash('flash_message', 'Las guías y la cotización no tienen la misma cantidad de registros');
                Session::flash('alert-class', 'alert-warning');
                return Redirect::to($this->variable);
            }
        } else {
            Session::flash('flash_message', 'Seleccione una guia válida');
            Session::flash('alert-class', 'alert-danger');
            return Redirect::to($this->variable);
        }
    }
    public function getProyectosPorCliente(Request $request)
    {
        $clienteId = $request->input('cliente_id');
        $proyectos = Proyectos::where('id_cliente', $clienteId)->get();
        return response()->json($proyectos);
    }

    public function NotaIngreso(Request $request)
    {
        $variable = $this->variable;
        $sub_guias = SubGuias::getLista($request->sel_guia);
        foreach ($sub_guias as $sub_guia){
            $id = 'devuelto_'.$sub_guia->id;
            if ($request->{$id} > 0){
                $sg = new SubGuias();
                $sg->descripcion = $sub_guia->descripcion;
                $sg->cantidad = ($request->{$id})*-1;
                $sg->id_guia = $sub_guia->id_guia;
                $sg->codigo = $sub_guia->codigo;
                $sg->estado = 2;
                $sg->save();
                $cot = Cotizaciones::findOrFail($sub_guia->guia->link);
                $cot->avance = $cot->avance - $request->{$id};
                $cot->estado = 1;
                $cot->save();
                $sub_cot = SubCotizaciones::where('id_cotizacion',$cot->id)->where('codigo',$sg->codigo)->first();
                $sub_cot->despachado = $sub_cot->despachado - $request->{$id};
                $sub_cot->estado = 1;
                $sub_cot->save();
                date_default_timezone_set('America/Lima');
                $fecha = date("Y-m-d H:i:s");
                $link = new Link();
                $link->id_cotizacion = $cot->id;
                $link->id_guia = $sub_guia->id_guia;
                $link->cantidad = ($request->{$id})*-1;
                $link->date_subida = $fecha;
                $link->id_sub_cotizacion = $sub_cot->id;
                $link->id_sub_guia = $sg->id;
                $link->id_user = $sub_guia->guia->id_user;
                $link->estado = 2;
                $link->save();
            }
        }
        Session::flash('flash_message', 'Se registró la Nota de Ingreso');
        Session::flash('alert-class', 'alert-success');
        return Redirect::to($variable);
    }

    public function despacho($id)
    {
        $variable = $this->variable;
        $codigo_d = Cotizaciones::where('id', $id)->first();
        $lista= SubCotizaciones::getLista($id);
        $lista_historial= Link::getLista($id);
//        dd($lista_historial,$id);

        return view('cotizaciones.despacho',compact('variable','lista','id','codigo_d','lista_historial'));
    }

    public function edit_cantidad(Request $request)
    {
        // $request->validate([
        //     'cantidad' => 'required|numeric|min:' . $request->despachado
        // ]);
        $material = Materiales::where('codigo', $request->codigo)->first();

        // Si el material no existe, mostrar un mensaje de error
        if (!$material) {
            $id_cotizacion = $request->id_cotizacion;
            // Redireccionar con un mensaje de error
            Session::flash('flash_message', 'El código no existe en la tabla de materiales');
            Session::flash('alert-class', 'alert-danger');
            return Redirect::to($this->variable_2 . '/' . $id_cotizacion);
        }

        if ($request->codigo) {
            $subcotizacion_e = SubCotizaciones::findOrFail($request->sub_cotizacion);
            $subcotizacion_e->codigo =$request->codigo;
            $subcotizacion_e->save();
        }

        if ($request->despachado == $request->cantidad) {
            $subcotizacion_e = SubCotizaciones::findOrFail($request->sub_cotizacion);
            $subcotizacion_e->estado =2;
            $subcotizacion_e->save();
        }else{
            $subcotizacion_e = SubCotizaciones::findOrFail($request->sub_cotizacion);
            $subcotizacion_e->estado =1;
            $subcotizacion_e->save();
        }

        $subcotizacion = SubCotizaciones::findOrFail($request->sub_cotizacion);
        $subcotizacion->cantidad = $request->cantidad;
        $subcotizacion->save();

        $id_cotizacion = $request->id_cotizacion;
        // $diferencia = $request->cantidad - $request->despachado;

        // Obtener la cotización específica
        $cotizacion = Cotizaciones::findOrFail($request->id_cotizacion);

        // Recalcular la columna programado sumando todas las cantidades de subcotizaciones
        $programado = SubCotizaciones::where('id_cotizacion', $request->id_cotizacion)
            ->sum('cantidad');

        // Actualizar el valor de la columna programado en la cotización
        $cotizacion->programado = $programado;

        // Verificar si el avance es igual al programado y actualizar el estado en consecuencia
        if ($cotizacion->avance == $cotizacion->programado) {
            $cotizacion->estado = 2; // Finalizado
        } else {
            $cotizacion->estado = 1; // Pendiente
        }

        // Guardar los cambios en la cotización
        $cotizacion->save();

        Session::flash('flash_message', 'Dato Actualizado Correctamente');
        Session::flash('alert-class', 'alert-success');
        return Redirect::to($this->variable_2 . '/' . $id_cotizacion);
    }

    public function cargar_html(Request $request)
    {
        if ($request->hasFile('archivo')) {
            // Guardar el archivo en el sistema de archivos de Laravel
            $archivo = $request->file('archivo');
            // $archivo = $request->file('archivo');

            // Obtener la extensión del archivo
            $extension = $archivo->getClientOriginalExtension();

            // Verificar si la extensión es HTML
            if (in_array(strtolower($extension), ['html', 'htm'])) {
                $nombreArchivo = $archivo->getClientOriginalName();
                Storage::putFileAs('archivos', $archivo, $nombreArchivo);

                // Leer el contenido del archivo
                $contenido = file_get_contents($archivo->getRealPath());

                // Parsear el HTML para extraer los datos
                $dom = new DOMDocument();

                // Suprimir los errores al cargar el HTML
                @$dom->loadHTML($contenido);
                $validador = $dom->getElementsByTagName('div');
                $frx1_6_textss = [];
                    foreach ($validador as $element) {
                        if ($element->getAttribute('class') === 'FRX1_48') {
                            $frx1_6_text = trim($element->textContent);
                            if (!empty($frx1_6_text)) {
                                $frx1_6_textss[] = $frx1_6_text;
                            }
                        }
                    }

                if ($frx1_6_textss ==  ["NORMAS INTERNACIONALES"]) {
                    //LUTON
                    $frx1_6_elements = $dom->getElementsByTagName('div');
                    $frx1_6_texts = [];
                    foreach ($frx1_6_elements as $element) {
                        if ($element->getAttribute('class') === 'FRX1_49') {
                            $frx1_6_text = trim($element->textContent);
                            if (!empty($frx1_6_text)) {
                                $frx1_6_texts[] = $frx1_6_text;
                            }
                        }
                    }
                    $frx1_25_elements = $dom->getElementsByTagName('div');
                    $frx1_25_texts = [];
                    foreach ($frx1_25_elements as $element) {
                        if ($element->getAttribute('class') === 'FRX1_24') {
                            $frx1_25_text = trim($element->textContent);
                            if (!empty($frx1_25_text)) {
                                $frx1_25_texts[] = $frx1_25_text;
                            }
                        }
                    }
                    // $frx1_23_elements = $dom->getElementsByTagName('div');
                    // $frx1_23_texts = [];
                    // foreach ($frx1_23_elements as $element) {
                    //     if ($element->getAttribute('class') === 'FRX1_23') {
                    //         $frx1_23_text = trim($element->textContent);
                    //         if (!empty($frx1_23_text)) {
                    //             $frx1_23_texts[] = $frx1_23_text;
                    //         }
                    //     }
                    // }

                    $frx1_23_elements = $dom->getElementsByTagName('div');
                    $frx1_23_texts = [];

                    foreach ($frx1_23_elements as $element) {
                        if ($element->getAttribute('class') === 'FRX1_23') {
                            $frx1_23_text = trim($element->textContent);
                            if (!empty($frx1_23_text)) {
                                // Aplicar la lógica para extraer la parte de la cadena que comienza con "COT"
                                $regex = '/COT-\d+/'; // Expresión regular para encontrar "COT-xxxxxx"
                                preg_match($regex, $frx1_23_text, $matches);
                                if (!empty($matches)) {
                                    $frx1_23_texts[] = $matches[0]; // Agregar solo la parte que necesitas al array
                                }
                            }
                        }
                    }

                    $frx1_15_elements = $dom->getElementsByTagName('textarea');
                    $frx1_15_texts = [];
                    foreach ($frx1_15_elements as $element) {
                        if ($element->getAttribute('class') === 'FRX1_15') {
                            $frx1_15_text = trim($element->textContent);
                            if (!empty($frx1_15_text)) {
                                $frx1_15_texts[] = $frx1_15_text;
                            }
                        }
                    }


                    # code...
                }else{
                    $frx1_6_elements = $dom->getElementsByTagName('textarea');
                    $frx1_6_texts = [];
                    foreach ($frx1_6_elements as $element) {
                        if ($element->getAttribute('class') === 'FRX1_106') {
                            $frx1_6_text = trim($element->textContent);
                            if (!empty($frx1_6_text)) {
                                $frx1_6_texts[] = $frx1_6_text;
                            }
                        }
                    }
                    $frx1_25_elements = $dom->getElementsByTagName('div');
                    $frx1_25_texts = [];
                    foreach ($frx1_25_elements as $element) {
                        if ($element->getAttribute('class') === 'FRX1_42') {
                            $frx1_25_text = trim($element->textContent);
                            if (!empty($frx1_25_text)) {
                                $frx1_25_texts[] = $frx1_25_text;
                            }
                        }
                    }
                    //codigo
                    $frx1_23_elements = $dom->getElementsByTagName('div');
                    $frx1_23_texts = [];

                    foreach ($frx1_23_elements as $element) {
                        if ($element->getAttribute('class') === 'FRX1_26') {
                            $frx1_23_text = trim($element->textContent);
                            if (!empty($frx1_23_text)) {
                                // Aplicar la lógica para extraer la parte de la cadena que comienza con "COT"
                                $regex = '/COT-\d+/'; // Expresión regular para encontrar "COT-xxxxxx"
                                preg_match($regex, $frx1_23_text, $matches);
                                if (!empty($matches)) {
                                    $frx1_23_texts[] = $matches[0]; // Agregar solo la parte que necesitas al array
                                }
                            }
                        }
                    }
                    //DESCRIPCION
                    $frx1_15_elements = $dom->getElementsByTagName('div');
                    $frx1_15_texts = [];
                    foreach ($frx1_15_elements as $element) {
                        if ($element->getAttribute('class') === 'FRX1_41') {
                            $frx1_15_text = trim($element->textContent);
                            if (!empty($frx1_15_text)) {
                                $frx1_15_texts[] = $frx1_15_text;
                            }
                        }
                    }

                }
                // Consulta para verificar si los códigos existen en la tabla de materiales
                $codigosExistentes = Materiales::whereIn('codigo', $frx1_6_texts)->pluck('codigo')->toArray();

                // Identificar los códigos que no existen en la tabla de materiales
                $codigosNoExistentes = array_diff($frx1_6_texts, $codigosExistentes);
                return response()->json([
                    'code' => 200,
                    'success' => '',
                    'variable1' => $frx1_6_texts,
                    'variable2' => $frx1_25_texts,
                    'variable3' => $frx1_23_texts,
                    'variable4' => $frx1_15_texts,
                    'codigos_no_existentes' => $codigosNoExistentes, // Envía los códigos que no existen en la respuesta
                    'archivo_formato' => "html", // Envía los códigos que no existen en la respuesta

                ], 200);

            }
            else{
                // Crear un objeto lector para el archivo Excel
                $reader = IOFactory::createReader('Xlsx');

                try {
                    // Cargar el archivo Excel
                    $spreadsheet = $reader->load($archivo->getPathname());

                    // Obtener la primera hoja del archivo Excel
                    $sheet = $spreadsheet->getActiveSheet();

                    // Obtener el valor de la celda correspondiente a la fila 2 y columna A
                    $cotizacion = $sheet->getCell('A2')->getValue();

                    // Filtrar el código de cotización que comienza con "COT-"
                    preg_match('/COT-\d+/', $cotizacion, $matches);
                    $cotizacionFiltrada = $matches[0]; // Obtenemos el código de cotización filtrado

                    // Obtener las filas del rango A1:Dn (donde n es el número de la última fila con datos)
                    $data = $sheet->rangeToArray('A1:D' . $sheet->getHighestRow(), null, true, true, true);

                    $codigos = [];
                    $descripciones = [];
                    $precios = [];

                    // Iterar sobre las filas y extraer los datos
                    foreach ($data as $row) {
                        // Verificar si la columna A contiene un número (indicando una fila válida)
                        if (is_numeric($row['A'])) {
                            $codigos[] = $row['A']; // Columna A: Códigos
                            $descripciones[] = $row['B']; // Columna B: Descripciones
                            $precios[] = $row['D']; // Columna D: Precios
                        }
                    }
                    // Obtener los códigos existentes en la base de datos
                    $codigosExistentes = Materiales::whereIn('codigo', $descripciones)->pluck('codigo')->toArray();

                    // Inicializar un array para almacenar las descripciones correspondientes a los códigos existentes
                    $descripcionesEncontradas = [];
                    $descripciones = array_map('trim', $descripciones);
                    // Iterar sobre las descripciones obtenidas del archivo Excel
                    foreach ($descripciones as $descripcion) {
                        // Verificar si la descripción coincide con uno de los códigos existentes en la base de datos
                        if (in_array($descripcion, $codigosExistentes)) {
                            // Si coincide, buscar la descripción correspondiente en la base de datos
                            $material = Materiales::where('codigo', $descripcion)->first();
                            if ($material) {
                                // Si se encuentra el material, agregar su descripción al array
                                $descripcionesEncontradas[] = $material->descripcion;
                            }
                        }
                    }

                    // Obtener los códigos existentes en la base de datos
                    $codigosExistentes = Materiales::whereIn('codigo', $descripciones)->pluck('codigo')->toArray();

                    // Identificar los códigos que no existen en la tabla de materiales
                    $codigosNoExistentes = array_diff($descripciones, $codigosExistentes);
                    // Devolver los datos procesados
                    return response()->json([
                        'code' => 200,
                        'cotizacion' => $cotizacionFiltrada, // Código de cotización filtrado
                        'codigos' => $codigos,
                        'descripciones' => $descripciones,
                        'precios' => $precios,
                        'descripciones_encontradas' => $descripcionesEncontradas, // Descripciones correspondientes a los códigos existentes
                        'codigos_no_existentes' => $codigosNoExistentes, // Envía los códigos que no existen en la respuesta
                        'archivo_formato' => "excel",
                    ], 200);

                } catch (Exception $e) {
                    // Manejar cualquier Exception que ocurra durante la lectura del archivo
                    return response()->json([
                        'code' => 500,
                        'error' => 'Error al leer el archivo Excel'
                    ], 500);
                }

            }
        }
    }
    public function cargar_prueba(Request $request)
    {
        if ($request->hasFile('archivoo')) {
            // Guardar el archivo en el sistema de archivos de Laravel
            $archivo = $request->file('archivoo');
            // $nombreArchivo = $archivo->getClientOriginalName();
            // Storage::putFileAs('archivoo', $archivo, $nombreArchivo);

            // Leer el contenido del archivo
            $contenido = file_get_contents($archivo->getRealPath());

            // Parsear el HTML para extraer los datos
            $dom = new DOMDocument();

            // Suprimir los errores al cargar el HTML
            @$dom->loadHTML($contenido);
            dd($dom);

        }
    }
    public function cargar_html_post(Request $request)
{
    // Obtener los valores de las variables desde la solicitud
    $variable1Values = $request->input('codigo');
    $variable2Values = $request->input('cantidad');
    $variable3Values = $request->input('desripcion');
    $variable5Values = $request->input('titulo');
    $variableProyecto = $request->input('variableProyecto');
    $variableCliente = $request->input('variableCliente');
    $suma = array_sum(array_map('floatval', $variable2Values));

    $id_logeo = Auth::user()->id;

    // Verificar si la variableProyecto tiene datos
    if (!$variableProyecto) {
        // Si variableProyecto está vacía, retorna una respuesta de error indicando que el proyecto no ha sido seleccionado
        return response()->json('Seleccione un proyecto', 400);
    }

    // Verificar si ya existe una cotización con el mismo número
    $existingCotizacion = Cotizaciones::where('cotizacion', $variable5Values[0])->first();

    if ($existingCotizacion) {
        // Si ya existe una cotización con el mismo número, retornar un mensaje de error
        return response()->json('Ya existe una cotizacion con el mismo correlativo', 500);
    }

    $ultimoId = Cotizaciones::max('id');

    if ($ultimoId === null) {
        // Si no hay registros anteriores, asigna el ID inicial como 1
        $nuevoId = 1;
    } else {
        // Incrementar el ID en uno
        $nuevoId = $ultimoId + 1;
    }

    // Formatear el ID con ceros a la izquierda
    $codigoCotizacion = 'A-' . str_pad($nuevoId, 4, '0', STR_PAD_LEFT);

    // Crear la cotización con el código generado
    $cotizacion = Cotizaciones::create([
        'estado' => 1,
        'fecha' => date("Y-m-d"),
        'cotizacion' => $variable5Values[0],
        'id_user' => $id_logeo,
        'id_proyecto' => $variableProyecto,
        'id_cliente' => $variableCliente,
        'programado' => $suma,
    ]);

    if ($cotizacion) {
        foreach ($variable1Values as $key => $value) {
            SubCotizaciones::create([
                'descripcion' => $variable3Values[$key],
                'codigo' => $value,
                'cantidad' => $variable2Values[$key],
                'id_cotizacion' => $cotizacion->id
            ]);
        }

        return response()->json('Datos guardados correctamente', 200);
    } else {
        // Manejar el caso en que la creación de la cotización falla
        return response()->json('Error al crear la cotización', 500);
    }
}
    public function edit_codigo(Request $request)
    {
        // Obtener la cotización específica
        $id_cotizacion = $request->id_cotizacion;

        $cotizacion = Cotizaciones::findOrFail($request->id_cotizacion);

        // Actualizar el valor de la columna codigo en la cotización
        $cotizacion->cotizacion = $request->codigo;

        // Validar el campo 'codigo' en el modelo antes de guardar
        $validator = Validator::make($cotizacion->toArray(), [
            'cotizacion' => [
                'required',
                Rule::unique('cotizaciones')->ignore($cotizacion->id),
            ],
        ]);

        // Verificar si la validación falla
        if ($validator->fails()) {
            // Manejar el error, por ejemplo, redirigir de vuelta con un mensaje de error
            return back()->withErrors($validator)->withInput();
        }

        // Guardar los cambios en la cotización
        $cotizacion->save();
        Session::flash('flash_message', 'Dato Actualizado Correctamente');
        Session::flash('alert-class', 'alert-success');
        return Redirect::to($this->variable);
    }
    public function anular(Request $request)
    {
        try{
            DB::beginTransaction();
            $c = Cotizaciones::findOrfail($request->id_cotizacion);
            $c->estado = 3;
            $c->save();
            Session::flash('flash_message', 'Cotización Anulada Correctamente');
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return Redirect::to($this->variable);
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('flash_message', 'Error al anular, vuelva a intentar');
            Session::flash('alert-class', 'alert-danger');
            return Redirect::to($this->variable);
        }
    }


    // public function cargar_html(Request $request)
    // {
    //     $variable = $this->variable;

    //     if ($request->hasFile('archivo')) {
    //         // Guardar el archivo en el sistema de archivos de Laravel
    //         $archivo = $request->file('archivo');
    //         $nombreArchivo = $archivo->getClientOriginalName();
    //         Storage::putFileAs('archivos', $archivo, $nombreArchivo);
    //         // Excel::import(new HtmlImport, $archivo);
    //         // Leer el contenido del archivo
    //         $contenido = file_get_contents($archivo->getRealPath());
    //         // Parsear el HTML para extraer los datos
    //         $dom = new DOMDocument();
    //         // $dom = new DOMDocument();

    //         // Suprimir los errores al cargar el HTML
    //         @$dom->loadHTML($contenido);

    //         // Obtener todas las etiquetas <div> del documento
    //         $divs = $dom->getElementsByTagName('div');

    //         // Iterar sobre cada div para buscar la descripción específica
    //         foreach ($divs as $div) {
    //             // Obtener el contenido textual del div
    //             $texto = $div->textContent;

    //             // Utilizar una expresión regular para buscar la descripción específica
    //             if (preg_match('/Driver Lutron 1% M Va-140/i', $texto)) {
    //                 // Si se encuentra la descripción, imprimir el contenido del div
    //                 echo $texto;
    //                 break; // Salir del bucle una vez que se haya encontrado la descripción
    //             }
    //         }}
    // }



}
