<?php

use App\Models\RolPermiso;
use Illuminate\Support\Facades\Auth;

function valida_privilegio($permiso_id){
    $user_id=obtener_rol_id();
    $resultado=RolPermiso::consulta_privilegio($user_id,$permiso_id);
    if($resultado){
        return 1;
    }
    else{
        return 0;
    }
}
function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
    return $random_string;
}

if (! function_exists('str_limit_custom')) {
    function str_limit_custom($value, $limit = 100, $end = '...')
    {
        return mb_strlen($value, 'UTF-8') <= $limit ? $value : rtrim(mb_substr($value, 0, $limit, 'UTF-8')).$end;
    }
}

function obtener_rol_id(){
    if(Auth::guest()){
        $usuario='';
    }
    else{
        $usuario=Auth::user()->rol_id;
    }
    return $usuario;
}
function validachecked($checked)
{
    if($checked==1){
        return 1;
    }
    else{
        return 0;
    }
}
function fecha_hoy(){

    date_default_timezone_set('America/Lima');
    $fecha=date('d/m/Y');

    return $fecha;
}
function fecha_hoy_sin_guion(){

    $cadena=trim(fecha_hoy());
    $tamano=strlen($cadena);

    $anno=substr($cadena,6,$tamano);
    $dia=substr($cadena,0,2);
    $mes=substr($cadena,3,2);

    $valor=$anno.$mes.$dia;

    return $valor;
}
function obtener_usuario(){
    if(Auth::guest()){
        $usuario='';
    }
    else{
        $usuario=Auth::user()->id;
    }
    return $usuario;
}
function fecha_a_ingles($fecha){

    $cadena=trim($fecha);
    $tamano=strlen($cadena);

    $anno=substr($cadena,6,$tamano);
    $dia=substr($cadena,0,2);
    $mes=substr($cadena,3,2);

    $fecha=$anno."-".$mes."-".$dia;

    if ($fecha==='//')
    {
        $fecha="";
    }

    return $fecha;
}
function validaFiltroAutocomplete($campo){
    if($campo>=1){
        return $campo;
    }
    else{
        return NULL;
    }
}
function horaactual(){

    date_default_timezone_set('America/Lima');
    $fecha=date('Y-m-d h:i:s');
    return $fecha;
}
function fecha_a_espanol($fecha){

    $cadena=trim($fecha);
    $tamano=strlen($cadena);

    if($tamano>9)
    {
        $anno=substr($cadena,0,4);
        $mes=substr($cadena,5,2);
        $dia=substr($cadena,8,2);
    }
    else
    {
        $anno=substr($cadena,0,2);
        $mes=substr($cadena,3,2);
        $dia=substr($cadena,6,2);
    }
    $fecha=$dia."/".$mes."/".$anno;
    if ($fecha==='//')
    {
        $fecha="";
    }

    return $fecha;

}
function ceros_izquierda($texto,$max){
    return str_pad($texto,$max, "0", STR_PAD_LEFT);
}
