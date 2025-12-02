<?php

// Ruta al directorio del proyecto Laravel
$projectPath = __DIR__;

// Ejecutar el comando composer dump-autoload
exec("composer dump-autoload", $output, $returnCode);

// Verificar si el comando se ejecutó correctamente
if ($returnCode === 0) {
    echo "Comando 'composer dump-autoload' ejecutado correctamente.";
} else {
    echo "Ocurrió un error al ejecutar el comando 'composer dump-autoload'.";
}
?>