<?php

namespace App\Http\Controllers;

use App\Models\Cotizaciones;
use App\Models\GuiasTwo;
use App\Models\Inventario;
use App\Models\Materiales;
use App\Models\SubCotizaciones;
use App\Models\SubGuiasTwo;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $variable = 'inventario';
    protected $permiso = '8';

    // public function index()
    // {
    //     // Establecer la zona horaria
    //     date_default_timezone_set('America/Lima');

    //     // Obtener la fecha actual en formato YYYY-MM-DD
    //     $currentDate = date('Y-m-d');

    //     // Obtener la fecha actual como objeto Carbon para facilitar la comparación
    //     $currentDateObject = Carbon::now();

    //     // Crear una instancia del cliente GuzzleHTTP
    //     $client = new Client();

    //     try {
    //         // Hacer una solicitud GET a la URL de tu base de datos Firebase
    //         $response = $client->request('GET', 'https://conteo-9abb6-default-rtdb.firebaseio.com/.json');

    //         // Verificar el código de estado de la respuesta
    //         if ($response->getStatusCode() == 200) {
    //             // Decodificar el cuerpo de la respuesta JSON a un array asociativo
    //             $data = json_decode($response->getBody(), true);

    //             // Trabajar con los datos obtenidos
    //             // Por ejemplo, puedes obtener los datos de los nodos "Conteo" y "ConteoGA"
    //             $conteoData = $data['Conteo'] ?? [];

    //             // Inicializar un array para almacenar los registros filtrados por fecha actual
    //             $conteoDataFiltrado = [];

    //             // Filtrar los registros por fecha actual
    //             foreach ($conteoData as $conteo) {
    //                 $conteoDecodificado = json_decode($conteo, true);
    //                 $fechaRegistro = substr($conteoDecodificado[7], 0, 4) . '-' . substr($conteoDecodificado[7], 4, 2) . '-' . substr($conteoDecodificado[7], 6, 2);

    //                 // Crear un objeto Carbon para la fecha de registro
    //                 $fechaRegistroObject = Carbon::createFromFormat('Y-m-d', $fechaRegistro);

    //                 // Verificar si la fecha de registro es mayor o igual a la fecha actual y menor que la fecha actual más un día
    //                 if ($fechaRegistroObject->isSameDay($currentDateObject)) {
    //                     $conteoDataFiltrado[] = $conteoDecodificado;
    //                 } else {
    //                     // Puedes manejar los registros que no corresponden a la fecha actual aquí, si es necesario
    //                     // Por ejemplo, puedes imprimirlos para fines de depuración
    //                     // dd('Fecha actual: ' . $currentDate, 'Fecha de registro: ' . $fechaRegistro);
    //                 }
    //             }

    //             // Agrupar los elementos por el código del producto y ubicación
    //             $grupos = [];
    //             foreach ($conteoDataFiltrado as $conteo) {
    //                 $codigoProducto = $conteo[1] ?? null;
    //                 $ubicacion = $conteo[3] ?? null;
    //                 $usuario = $conteo[6] ?? null;

    //                 // Verificar si ya existe un grupo para este código de producto
    //                 if (!isset($grupos[$codigoProducto])) {
    //                     $grupos[$codigoProducto] = [
    //                         'codigo' => $codigoProducto,
    //                         'cantidad' => 0,
    //                         'descripcion' => $conteo[4], // Ajusta esto según la estructura de tus datos
    //                         'ubicaciones' => [],
    //                         'usuarios' => [],
    //                     ];
    //                 }

    //                 // Sumar la cantidad
    //                 $grupos[$codigoProducto]['cantidad'] += $conteo[2];

    //                 // Verificar si la ubicación ya existe en el grupo
    //                 if (!in_array($ubicacion, $grupos[$codigoProducto]['ubicaciones'])) {
    //                     $grupos[$codigoProducto]['ubicaciones'][] = $ubicacion;
    //                 }

    //                 // Verificar si el usuario ya existe en el grupo
    //                 if (!in_array($usuario, $grupos[$codigoProducto]['usuarios'])) {
    //                     $grupos[$codigoProducto]['usuarios'][] = $usuario;
    //                 }
    //             }

    //             // Concatenar ubicaciones si hay más de una
    //             foreach ($grupos as &$grupo) {
    //                 if (count($grupo['ubicaciones']) > 1) {
    //                     $grupo['ubicacion'] = implode(' / ', $grupo['ubicaciones']);
    //                 } else {
    //                     $grupo['ubicacion'] = $grupo['ubicaciones'][0];
    //                 }

    //                 // Concatenar usuarios si hay más de uno
    //                 if (count($grupo['usuarios']) > 1) {
    //                     $grupo['usuario'] = implode(' / ', $grupo['usuarios']);
    //                 } else {
    //                     $grupo['usuario'] = $grupo['usuarios'][0];
    //                 }
    //             }

    //             // Retornar la vista con los datos para mostrarlos
    //             return view('inventario.index', compact('grupos'));
    //         } else {
    //             // En caso de que la solicitud no sea exitosa, manejar el error
    //             return response()->json(['error' => 'Error al obtener los datos de Firebase'], $response->getStatusCode());
    //         }
    //     } catch (Exception $e) {
    //         // En caso de que ocurra una excepción, manejarla
    //         return response()->json(['error' => 'Excepción: ' . $e->getMessage()], 500);
    //     }
    // }
    public function index()
{
    // Establecer la zona horaria
    date_default_timezone_set('America/Lima');

    // Obtener la fecha actual en formato YYYY-MM-DD
    $currentDate = date('Y-m-d');

    // Obtener la fecha actual como objeto Carbon para facilitar la comparación
    $currentDateObject = Carbon::now();

    // Crear una instancia del cliente GuzzleHTTP
    $client = new Client();

    try {
        // Hacer una solicitud GET a la URL de tu base de datos Firebase
        $response = $client->request('GET', 'https://conteo-9abb6-default-rtdb.firebaseio.com/.json');

        // Verificar el código de estado de la respuesta
        if ($response->getStatusCode() == 200) {
            // Decodificar el cuerpo de la respuesta JSON a un array asociativo
            $data = json_decode($response->getBody(), true);

            // Trabajar con los datos obtenidos
            $conteoData = $data['Conteo'] ?? [];

            // Inicializar un array para almacenar los registros filtrados por fecha actual
            $conteoDataFiltrado = [];

            // Filtrar los registros por fecha actual
            foreach ($conteoData as $timestamp => $jsonString) {
                try {
                    // Decodificar el JSON almacenado como string
                    $conteoDecodificado = json_decode($jsonString, true);

                    // Verificar si se decodificó correctamente
                    if ($conteoDecodificado !== null) {
                        // Obtener la fecha de registro del conteo
                        $fechaRegistro = $conteoDecodificado[0];

                        // Crear un objeto Carbon para la fecha de registro
                        $fechaRegistroObject = Carbon::createFromFormat('Ymd', $fechaRegistro);

                        // Verificar si la fecha de registro es igual a la fecha actual
                        if ($fechaRegistroObject->isSameDay($currentDateObject)) {
                            $conteoDataFiltrado[] = $conteoDecodificado;
                        }
                    } else {
                        // Manejar errores de decodificación
                        throw new Exception('Error al decodificar el conteo: ' . json_last_error_msg());
                    }
                } catch (Exception $e) {
                    // Manejar errores durante la decodificación
                    // Puedes registrar el error o simplemente omitir el registro problemático
                    continue;
                }
            }
            //EMPIEZA OTRO
            // Inicializar arrays para almacenar las sumas de cantidad por estado
            // Obtener todas las guías de "Préstamo" con estado 1
            $guias_prestamo = GuiasTwo::where("motivo", "Préstamo")->where("estado", 1)->get();

            // Inicializar un array para almacenar los resultados por material para "Préstamo"
            $resultados_por_material_prestamo = [];

            // Iterar sobre cada guía de "Préstamo"
            foreach ($guias_prestamo as $guia) {
                // Obtener el ID de la guía
                $id_guia = $guia->id;

                // Obtener las unidades sumadas por material para la guía actual de "Préstamo"
                $unidades_por_material_prestamo = SubGuiasTwo::where("id_guia_two", $id_guia)
                                                    ->select('material', DB::raw('SUM(unidad) as total_unidades'))
                                                    ->groupBy('material')
                                                    ->get();

                // Iterar sobre los resultados de unidades sumadas por material para "Préstamo"
                foreach ($unidades_por_material_prestamo as $unidad) {
                    // Obtener el ID del material y la suma total de unidades
                    $nombre_material_id = $unidad->material;
                    $suma_unidades = $unidad->total_unidades;

                    // Obtener el código del material utilizando el ID
                    $material = Materiales::find($nombre_material_id);

                    // Verificar si se encontró el material y obtener su código
                    if ($material) {
                        $codigo_material = $material->codigo;

                        // Verificar si ya existe una entrada para este material en los resultados
                        if (isset($resultados_por_material_prestamo[$codigo_material])) {
                            // Sumar la cantidad de unidades al resultado existente
                            $resultados_por_material_prestamo[$codigo_material] += $suma_unidades;
                        } else {
                            // Crear una nueva entrada para el material en los resultados
                            $resultados_por_material_prestamo[$codigo_material] = $suma_unidades;
                        }
                    }
                }
            }
            //EMPIEZA OTRO

            // Obtener todas las guías de "Despacho por cambios" con estado 1
            $guias_cambios = GuiasTwo::where("motivo", "Despacho por cambios")->where("estado", 1)->get();

            // Inicializar un array para almacenar los resultados por material para "Despacho por cambios"
            $resultados_por_material_cambios = [];

            // Iterar sobre cada guía de "Despacho por cambios"
            foreach ($guias_cambios as $guia) {
                // Obtener el ID de la guía
                $id_guia_cambios = $guia->id;

                // Obtener las unidades sumadas por material para la guía actual de "Despacho por cambios"
                $unidades_por_material_cambios = SubGuiasTwo::where("id_guia_two", $id_guia_cambios)
                                                    ->select('material', DB::raw('SUM(unidad) as total_unidades'))
                                                    ->groupBy('material')
                                                    ->get();

                // Iterar sobre los resultados de unidades sumadas por material para "Despacho por cambios"
                foreach ($unidades_por_material_cambios as $unidad) {
                    // Obtener el ID del material y la suma total de unidades
                    $nombre_material_id_cambios = $unidad->material;
                    $suma_unidades_cambios = $unidad->total_unidades;

                    // Obtener el código del material utilizando el ID
                    $material_cambios = Materiales::find($nombre_material_id_cambios);

                    // Verificar si se encontró el material y obtener su código
                    if ($material_cambios) {
                        $codigo_material_cambios = $material_cambios->codigo;

                        // Verificar si ya existe una entrada para este material en los resultados
                        if (isset($resultados_por_material_cambios[$codigo_material_cambios])) {
                            // Sumar la cantidad de unidades al resultado existente
                            $resultados_por_material_cambios[$codigo_material_cambios] += $suma_unidades_cambios;
                        } else {
                            // Crear una nueva entrada para el material en los resultados
                            $resultados_por_material_cambios[$codigo_material_cambios] = $suma_unidades_cambios;
                        }
                    }
                }
            }
            //EMPIEZA OTRO

            //EMPIEZA OTRO
            $cotizacicones = Cotizaciones::where("estado", 1)->get();

            // Inicializar un array para almacenar los resultados por material para "Despacho por cambios"
            $resultados_por_cotizacion = [];

            // Iterar sobre cada guía de "Despacho por cambios"
            foreach ($cotizacicones as $coti) {
                // Obtener el ID de la guía
                $id_coti = $coti->id;

                // Obtener las unidades sumadas por material para la guía actual de "Despacho por cambios"
                $unidades_por_cotizacion = SubCotizaciones::where("id_cotizacion", $id_coti)
                ->select('codigo', DB::raw('SUM(cantidad) as total_unis'))
                ->groupBy('codigo')
                ->get();

                // foreach ($unidades_por_cotizacion as $unidades) {
                //     $nombre_material_id_cambios = $unidades->codigo;
                //     $suma_unidades_cambios = $unidades->total_unis;
        
                //     $material_cambios = Materiales::find($nombre_material_id_cambios);
        
                //     if ($material_cambios) {
                //         $codigo_material_cambios = $material_cambios->codigo;
                //         $resultados_por_material_cambios[$codigo_material_cambios] = $suma_unidades_cambios;
                //     }
                // }
                // Iterar sobre los resultados de unidades sumadas por material para "Despacho por cambios"
                foreach ($unidades_por_cotizacion as $unidades) {
                    // Obtener el ID del material y la suma total de unidades
                    $material_cotizacion = $unidades->codigo;
                    $suma_unidades = $unidades->total_unis;

                    // Obtener el código del material udtilizando el ID
                    $cotizacion_cambios = Materiales::where("codigo",$material_cotizacion)->first();

                    // Verificar si se encontró el material y obtener su código
                    if ($cotizacion_cambios) {
                        
                        $codigo_material_cotizacion= $cotizacion_cambios->codigo;

                        // Verificar si ya existe una entrada para este material en los resultados
                        if (isset($resultados_por_cotizacion[$codigo_material_cotizacion])) {
                            // Sumar la cantidad de unidades al resultado existente
                            $resultados_por_cotizacion[$codigo_material_cotizacion] += $suma_unidades;
                        } else {
                            // Crear una nueva entrada para el material en los resultados
                            $resultados_por_cotizacion[$codigo_material_cotizacion] = $suma_unidades;
                        }
                    }else{
                        $resultados_por_cotizacion= "";
                    }
                }
            }
            // dd($resultados_por_cotizacion);
            //EMPIEZA OTRO

            $estado2Cantidad = 0;
            $estado3Cantidad = 0;

            // Agrupar los elementos por el código del producto y ubicación
            $grupos = [];
            // Iterar sobre cada conteo filtrado
            foreach ($conteoDataFiltrado as $conteo) {
                $codigoProducto = $conteo[1] ?? null;
                $ubicacion = $conteo[3] ?? null;
                $usuario = $conteo[6] ?? null;
                $estado = $conteo[5] ?? null;
                $cantidad = $conteo[2] ?? 0;

                // Verificar si el código del producto existe en los resultados de "Préstamo"
                $cantidad_prestamo = isset($resultados_por_material_prestamo[$codigoProducto]) ? $resultados_por_material_prestamo[$codigoProducto] : 0;
                
                // Verificar si el código del producto existe en los resultados de "Despacho por cambios"
                $cantidad_cambios = isset($resultados_por_material_cambios[$codigoProducto]) ? $resultados_por_material_cambios[$codigoProducto] : 0;

                // Verificar si el código del producto existe en los resultados de "Cotizaciones"
                $cantidad_cotizacion = isset($resultados_por_cotizacion[$codigoProducto]) ? $resultados_por_cotizacion[$codigoProducto] : 0;

                // Verificar si el grupo ya existe para este código de producto
                if (!isset($grupos[$codigoProducto])) {
                    $grupos[$codigoProducto] = [
                        'codigo' => $codigoProducto,
                        'cantidad' => 0, // Cantidad inicial en 0
                        'descripcion' => isset($conteo[4]) ? $conteo[4] : '', // Ajustar según la estructura de datos
                        'ubicaciones' => [],
                        'usuarios' => [],
                        'estado_2' => 0, // Inicializar estado_2 en 0 para este producto
                        'estado_3' => 0, // Inicializar estado_3 en 0 para este producto
                        'prestamo' => $cantidad_prestamo,
                        'cambios' => $cantidad_cambios,
                        'cotizacion' => $cantidad_cotizacion,
                    ];
                }

                // Sumar la cantidad total del grupo para este producto
                $grupos[$codigoProducto]['cantidad'] += $cantidad;

                // Verificar si la ubicación ya existe en el grupo
                if (!in_array($ubicacion, $grupos[$codigoProducto]['ubicaciones'])) {
                    $grupos[$codigoProducto]['ubicaciones'][] = $ubicacion;
                }

                // Verificar si el usuario ya existe en el grupo
                if (!in_array($usuario, $grupos[$codigoProducto]['usuarios'])) {
                    $grupos[$codigoProducto]['usuarios'][] = $usuario;
                }

                // Sumar la cantidad por estado específico para este producto
                if ($estado == 2) {
                    $grupos[$codigoProducto]['estado_2'] += $cantidad;
                } elseif ($estado == 3) {
                    $grupos[$codigoProducto]['estado_3'] += $cantidad;
                }
            }

            // Concatenar ubicaciones si hay más de una
            foreach ($grupos as &$grupo) {
                if (count($grupo['ubicaciones']) > 1) {
                    $grupo['ubicacion'] = implode(' / ', $grupo['ubicaciones']);
                } else {
                    $grupo['ubicacion'] = $grupo['ubicaciones'][0];
                }

                // Concatenar usuarios si hay más de uno
                if (count($grupo['usuarios']) > 1) {
                    $grupo['usuario'] = implode(' / ', $grupo['usuarios']);
                } else {
                    $grupo['usuario'] = $grupo['usuarios'][0];
                }
            }

            // Retornar la vista con los datos para mostrarlos
            return view('inventario.index', compact('grupos'));
        } else {
            // En caso de que la solicitud no sea exitosa, manejar el error
            return response()->json(['error' => 'Error al obtener los datos de Firebase'], $response->getStatusCode());
        }
    } catch (Exception $e) {
        // En caso de que ocurra una excepción, manejarla
        return response()->json(['error' => 'Excepción: ' . $e->getMessage()], 500);
    }
}
}