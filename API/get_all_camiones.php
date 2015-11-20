<?php
/**
 * Obtiene todas las metas de la base de datos
 */

require 'camiones.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $rutas = Camion::getAll();

    if ($rutas) {

        $datos["estado"] = 1;
        $datos["rutas"] = $rutas;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

?>
