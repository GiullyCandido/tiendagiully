<?php
    // Esta funcion carga automáticamente las clases cuando son necesarias. Esto significa que no necesitas usar require_once o include manualmente cada vez que quieras usar una clase en las views.
    session_start();
    function autoloadClass($nombreClase){
        // DIR: Devuelve la ruta del archivo donde lo llamas. 
        $archivoClase = __DIR__."/../class/$nombreClase.php";
        if( file_exists($archivoClase) ){
            require_once $archivoClase;
        }

    }
    spl_autoload_register("autoloadClass");