<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Cotizaciones;
use App\Models\Guias;
use App\Models\GuiasTwo;
use App\Models\Link;
use App\Models\Materiales;
use App\Models\SubCotizaciones;
use App\Models\SubGuias;
use App\Models\SubGuiasTwo;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DOMDocument;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use function Laravel\Prompts\select;

class GuiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $variable = 'guias';
    protected $variable_2 = 'guiastwo';
    protected $permiso = '9';


    public function index()
    {
        $variable = $this->variable;
        $lista = Guias::getLista();

        $lista_cotizacion_filtro = Cotizaciones::getListaF();

        return view('guias.index', compact('variable', 'lista', 'lista_cotizacion_filtro'));
    }

    public function cargar_guia(Request $request)
    {
        $variable = $this->variable;

        if ($request->hasFile('archivo')) {
            // Guardar el archivo en el sistema de archivos de Laravel
            $archivo = $request->file('archivo');
            $nombreArchivo = $archivo->getClientOriginalName();
            Storage::putFileAs('guias', $archivo, $nombreArchivo);
            // Excel::import(new HtmlImport, $archivo);
            // Leer el contenido del archivo
            $contenido = file_get_contents($archivo->getRealPath());
            // Parsear el HTML para extraer los datos
            $dom = new DOMDocument();
            // $dom = new DOMDocument();

            // Suprimir los errores al cargar el HTML
            @$dom->loadHTML($contenido);
            dd($dom);
            // Obtener todas las etiquetas <div> del documento
            $divs = $dom->getElementsByTagName('div');

            // Iterar sobre cada div para buscar la descripción específica
            foreach ($divs as $div) {
                // Obtener el contenido textual del div
                $texto = $div->textContent;

                // Utilizar una expresión regular para buscar la descripción específica
                if (preg_match('/Driver Lutron 1% M Va-140/i', $texto)) {
                    // Si se encuentra la descripción, imprimir el contenido del div
                    echo $texto;
                    break; // Salir del bucle una vez que se haya encontrado la descripción
                }
            }
        }
    }

    public function cargar_html_g(Request $request)
    {
        if ($request->hasFile('archivo')) {
            // Guardar el archivo en el sistema de archivos de Laravel
            $archivo = $request->file('archivo');
            $nombreArchivo = $archivo->getClientOriginalName();
            Storage::putFileAs('archivos', $archivo, $nombreArchivo);

            // Leer el contenido del archivo
            $contenido = file_get_contents($archivo->getRealPath());

            // Parsear el HTML para extraer los datos
            $dom = new DOMDocument();

            // Suprimir los errores al cargar el HTML
            @$dom->loadHTML($contenido);
            //Codigo
            $frx1_6_elements = $dom->getElementsByTagName('div');
            $frx1_6_texts = [];
            foreach ($frx1_6_elements as $element) {
                if ($element->getAttribute('class') === 'FRX1_26') {
                    $frx1_6_text = trim($element->textContent);
                    if (!empty($frx1_6_text)) {
                        $frx1_6_texts[] = $frx1_6_text;
                    }
                }
            }
            //descripcion
            $frx1_25_elements = $dom->getElementsByTagName('div');
            $frx1_25_texts = [];
            foreach ($frx1_25_elements as $element) {
                if ($element->getAttribute('class') === 'FRX1_25') {
                    $frx1_25_text = trim($element->textContent);
                    if (!empty($frx1_25_text)) {
                        $frx1_25_texts[] = $frx1_25_text;
                    }
                }
            }
            //cantidad
            $frx1_23_elements = $dom->getElementsByTagName('div');
            $frx1_23_texts = [];
            foreach ($frx1_23_elements as $element) {
                if ($element->getAttribute('class') === 'FRX1_96') {
                    $frx1_23_text = trim($element->textContent);
                    if (!empty($frx1_23_text)) {
                        $frx1_23_texts[] = $frx1_23_text;
                    }
                }
            }
            //GUIAS- IDENFIICACION
            $frx1_15_elements = $dom->getElementsByTagName('div');
            $frx1_15_texts = [];
            foreach ($frx1_15_elements as $element) {
                if ($element->getAttribute('class') === 'FRX1_16') {
                    $frx1_15_text = trim($element->textContent);
                    if (!empty($frx1_15_text)) {
                        $frx1_15_texts[] = $frx1_15_text;
                    }
                }
            }


            # code...


            return response()->json([
                'code' => 200,
                'success' => 'Actualizado Correctamente',
                'variable1' => $frx1_6_texts,//codigo
                'variable2' => $frx1_23_texts,//descripcion
                'variable4' => $frx1_25_texts,//cantidad
                'variable3' => $frx1_15_texts//identicaiion
            ], 200);

        }
    }

    public function guia_nulas(Request $request)
    {
        $variable = $this->variable;

        $id_logeo = Auth::user()->id;
        date_default_timezone_set('America/Lima');

        // Obtener la fecha y hora actual en el formato adecuado
        $fecha_y_hora_actual = date("Y-m-d H:i:s");

        $usuario = new Guias();
        $usuario->fecha = $fecha_y_hora_actual;
        $usuario->guia = $request->dato_nulo;
        $usuario->id_user = $id_logeo;
        $usuario->estado = 0;
        $usuario->save();


        Session::flash('flash_message', 'Guia Nula Creada Correctamente');
        Session::flash('alert-class', 'alert-success');
        return Redirect::to($this->variable);
    }

    public function guia_nulas_two(Request $request)
    {
        $variable = $this->variable;

        $id_logeo = Auth::user()->id;
        date_default_timezone_set('America/Lima');

        // Obtener la fecha y hora actual en el formato adecuado
        $fecha_y_hora_actual = date("Y-m-d H:i:s");

        $usuario = new GuiasTwo();
        $usuario->fecha = $fecha_y_hora_actual;
        $usuario->guia = $request->dato_nulo;
        $usuario->id_user = $id_logeo;
        $usuario->estado = 0;
        $usuario->save();


        Session::flash('flash_message', 'Guia Nula Creada Correctamente');
        Session::flash('alert-class', 'alert-success');
        return Redirect::to($this->variable_2);
    }

    public function cargar_html_postg(Request $request)
    {

        $variable1Values = $request->input('codigo');
        $variable2Values = $request->input('cantidad');
        $variable3Values = $request->input('desripcion');
        $variable5Values = $request->input('titulo');
        $variableMotivo = $request->input('variableMotivo');
        $suma = array_sum(array_map('floatval', $variable2Values));

        $id_logeo = Auth::user()->id;
        // Validación de datos repetidos en la columna guia
        $guiaExistente = Guias::where('guia', $variable5Values[0])->first();
        if ($guiaExistente) {
            return response()->json('El correlativo ya existe', 400);
        }

        // Validación del orden secuencial
        $ultimoRegistro = Guias::orderBy('id', 'desc')->first();
        if ($ultimoRegistro) {
            $ultimoCorrelativo = $ultimoRegistro->guia;
            $ultimoNumero = intval(substr($ultimoCorrelativo, strrpos($ultimoCorrelativo, '-') + 1));
            $nuevoNumero = intval(substr($variable5Values[0], strrpos($variable5Values[0], '-') + 1));
            if ($nuevoNumero !== $ultimoNumero + 1) {
                return response()->json('El correlativo no sigue un orden secuencial.', 400);
            }
        }

        // Formatear el ID con ceros a la izquierda
        // Establecer la zona horaria a Lima, Perú
        date_default_timezone_set('America/Lima');

        // Obtener la fecha y hora actual en el formato adecuado
        $fecha_y_hora_actual = date("Y-m-d H:i:s");

        // Crear la cotización con el código generado
        $guia = Guias::create([
            'fecha' => $fecha_y_hora_actual,
            'motivo' => $variableMotivo,
            'guia' => $variable5Values[0],
            'cantidad' => $suma,
            // 'cantidad' => $id_logeo,
            'link' => "",
            'id_user' => $id_logeo,
        ]);
        if ($guia) {
            foreach ($variable1Values as $key => $value) {
                SubGuias::create([
                    'descripcion' => $variable3Values[$key],
                    'codigo' => $value,
                    'cantidad' => $variable2Values[$key],
                    'id_guia' => $guia->id
                ]);
            }

            return response()->json(['message' => 'Datos guardados correctamente'], 200);
        } else {
            // Manejar el caso en que la creación de la cotización falla
            return response()->json(['message' => 'Error al crear la cotización'], 500);
        }
        // Manejar el caso en que la creación de la cotización falla
        // return response()->json(['message' => 'Datos guardados correctamente'], 200);


        // Si deseas retornar una respuesta de éxito al cliente, puedes hacerlo así
        // return response()->json(['message' => 'Datos guardados correctamente'], 200);
        // return response()->json(['code'=>200,'success' => 'Actualizado Correctamente'],200);

    }

    public function link_cotizacion(Request $request)
    {
        if ($request->id_cotizacion != "0") {
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
                                $id_logeo = Auth::user()->id;

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
                Guias::where('id', $convertir)->update(['estado' => 2, 'link' => $id_cotizacion]);


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

    public function guias_two()
    {
        $variable = $this->variable;
        $lista = GuiasTwo::getLista();
        $materiales = Materiales::getLista();
        $clientes = Clientes::getLista();
        return view('guias.guiastwo', compact('variable', 'lista', 'materiales', 'clientes'));
    }

    public function estados_guia(Request $request)
    {
        $variable = $this->variable;
        $g = Guias::findOrfail($request->id);
        $g->estado = $request->estado;
        $g->save();
        Session::flash('flash_message', 'Se actualizó el estado');
        Session::flash('alert-class', 'alert-success');
        return Redirect::to($variable);
    }
    public function estados_guiatwo(Request $request)
    {
        $variable = $this->variable_2;
        $g = GuiasTwo::findOrfail($request->id);
        $g->estado = $request->estado;
        $g->save();
        Session::flash('flash_message', 'Se actualizó el estado');
        Session::flash('alert-class', 'alert-success');
        return Redirect::to($variable);
    }

    public function two_guardar(Request $request)
    {
        $variable = $this->variable;
        date_default_timezone_set('America/Lima');
        $fecha_y_hora_actual = date("Y-m-d H:i:s");
        $id_logeo = Auth::user()->id;

        // Crear una nueva GuiaTwo
        $correlativot = str_pad($request->correlativo, 7, "0", STR_PAD_LEFT);
        $comparar = "T002-" . $correlativot;
        $guiaExistente = GuiasTwo::where('guia', $comparar)->first();
        if ($guiaExistente) {
            Session::flash('flash_message', 'El correlativo ya existe');
            Session::flash('alert-class', 'alert-danger');
            return Redirect::to($this->variable_2);
        } else {
            $ultimoRegistro = GuiasTwo::orderBy('id', 'desc')->first();
            if ($ultimoRegistro) {
                $ultimoCorrelativo = $ultimoRegistro->guia;
                $ultimoNumero = intval(substr($ultimoCorrelativo, strrpos($ultimoCorrelativo, '-') + 1));
                $nuevoNumero = intval(substr($comparar, strrpos($comparar, '-') + 1));
                if ($nuevoNumero !== $ultimoNumero + 1) {
                    // return response()->json('El correlativo no sigue un orden secuencial.', 400);
                    Session::flash('flash_message', 'El correlativo no sigue un orden secuencial');
                    Session::flash('alert-class', 'alert-danger');
                    return Redirect::to($this->variable_2);
                }
            }
            $despacho = new GuiasTwo();
            $despacho->id_cliente = $request->cliente_id2;
            $despacho->id_proyecto = $request->proyecto_id2;
            $despacho->fecha = $fecha_y_hora_actual;
            $despacho->motivo = $request->motivo;

            // Obtener el correlativo y agregar ceros adicionales
            $correlativo = str_pad($request->correlativo, 7, "0", STR_PAD_LEFT);
            $despacho->guia = "002-" . $correlativo;
            $despacho->id_user = $id_logeo;
            // Guardar la GuiaTwo para obtener su ID
            $despacho->save();

            // Guardar los elementos del despacho y calcular la cantidad total
            $cantidad_total = 0;
            foreach ($request->elemento as $key => $elementoId) {
                $elementoDespacho = new SubGuiasTwo();
                $elementoDespacho->id_guia_two = $despacho->id;
                $elementoDespacho->material = $elementoId;
                $elementoDespacho->unidad = $request->cantidad[$key];
                $elementoDespacho->save();

                // Sumar la cantidad al total
                $cantidad_total += $request->cantidad[$key];
            }

            // Asignar la cantidad total a la GuiaTwo
            $despacho->cantidad = $cantidad_total;

            $despacho->save();

            Session::flash('flash_message', 'Datos guardados correctamente');
            Session::flash('alert-class', 'alert-success');
            return Redirect::to($this->variable_2);
        }


    }

    public function eliminar_two($id)
    {
        // Encuentra el proyecto por su ID
        // $proyecto = Proyectos::findOrFail($id);
        $proyectos = GuiasTwo::findOrFail($id);

        $proyectos->update(['estado' => 2]); // Suponiendo que el estado 2 representa "anulado"

        Session::flash('flash_message', 'Anulado Correctamente');
        Session::flash('alert-class', 'alert-danger');
        return Redirect::to($this->variable_2);

    }

    public function transportar_guiatwo($id)
    {
        $g2 = GuiasTwo::findOrFail($id);
        $count_g1 = Guias::Select('id')->get()->count();
        $temp = 3860 + ($count_g1 + 1);
        $g1 = new Guias();
        $g1->fecha = $g2->fecha;
        $g1->motivo = $g2->motivo;
        $g1->guia = 'T001-000' . $temp;
        $g1->codigo_articulo = $g2->codigo_articulo;
        $g1->articulo = $g2->articulo;
        $g1->cantidad = $g2->cantidad;
        $g1->id_user = $g2->id_user;
        $g1->estado = $g2->estado;
        $g1->save();
        $g2->estado = 3;
        $g2->g1 = $g1->guia;
        $g2->save();
        $g2_detalles = SubGuiasTwo::getLista($g2->id);
        foreach ($g2_detalles as $g2_detalle) {
            $material = Materiales::findOrFail($g2_detalle->material);
            if (!$material) {
                Session::flash('flash_message', 'El material ' . $g2_detalle->material . ' No existe');
                Session::flash('alert-class', 'alert-danger');
                return Redirect::to($this->variable_2);
            } else {
                $g1_detalle = new SubGuias();
                $g1_detalle->descripcion = $material->descripcion;
                $g1_detalle->cantidad = $g2_detalle->unidad;
                $g1_detalle->id_guia = $g1->id;
                $g1_detalle->codigo = $material->codigo;
                $g1_detalle->estado = 1;
                $g1_detalle->save();
            }
        }
        Session::flash('flash_message', 'Guía Transportada Correctamente');
        Session::flash('alert-class', 'alert-success');
        return Redirect::to($this->variable_2);
    }

    public function editar_two($id)
    {

    }
    //  public function consumir_api()
    // {
    //     {
    //         // Crear una instancia del cliente GuzzleHTTP
    //         $client = new Client();

    //         try {
    //             // Hacer una solicitud GET a la URL de tu base de datos Firebase
    //             $response = $client->request('GET', 'https://conteo-9abb6-default-rtdb.firebaseio.com');

    //             // Verificar el código de estado de la respuesta
    //             if ($response->getStatusCode() == 200) {
    //                 // Decodificar el cuerpo de la respuesta JSON a un array asociativo
    //                 $data = json_decode($response->getBody(), true);

    //                 // Trabajar con los datos obtenidos
    //                 // Por ejemplo, puedes imprimir los datos en la vista
    //                 return view('firebase_data', ['data' => $data]);


    //             } else {
    //                 // En caso de que la solicitud no sea exitosa, manejar el errorException
    //                 return response()->json(['error' => 'Error al obtener los datos de Firebase'], $response->getStatusCode());
    //             }
    //         } catch (Exception $e) {
    //             // En caso de que ocurra una excepción, manejarla
    //             return response()->json(['error' => 'Excepción: ' . $e->getMessage()], 500);
    //         }
    // }
    // }
    public function consumir_api()
    {
        // Crear una instancia del cliente GuzzleHTTP
        $client = new Client();

        try {
            // Hacer una solicitud GET a la URL de tu base de datos Firebase
            // $response = $client->request('GET', 'https://newproyect-e15d0-default-rtdb.firebaseio.com/.json');
            $response = $client->request('GET', 'https://conteo-9abb6-default-rtdb.firebaseio.com/.json');
            // Verificar el código de estado de la respuesta
            if ($response->getStatusCode() == 200) {
                // Decodificar el cuerpo de la respuesta JSON a un array asociativo
                $data = json_decode($response->getBody(), true);

                // Trabajar con los datos obtenidos
                // Por ejemplo, puedes obtener los datos de los nodos "Conteo" y "ConteoGA"
                $conteoData = $data['Conteo'] ?? [];
                $conteoGAData = $data['ConteoGA'] ?? [];

                // Retornar la vista con los datos para mostrarlos
                return view('inventario.index', compact('conteoData', 'conteoGAData'));
            } else {
                // En caso de que la solicitud no sea exitosa, manejar el error
                return response()->json(['error' => 'Error al obtener los datos de Firebase'], $response->getStatusCode());
            }
        } catch (Exception $e) {
            // En caso de que ocurra una excepción, manejarlaException
            return response()->json(['error' => 'Excepción: ' . $e->getMessage()], 500);
        }

    }
    public function getmateriales($guia)
    {
        $materiales = Subguias::getLista($guia);
        foreach ($materiales as $material){
            $sg = Subguias::where('codigo',$material->codigo)->where('id_guia',$guia)->where('estado',2)->get()->sum('cantidad');
            $material->cantidad = $material->cantidad + $sg;
        }
        return response()->json($materiales);
    }
}
