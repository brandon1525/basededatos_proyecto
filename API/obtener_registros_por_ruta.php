<?php

require 'camiones.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['ruta'])) {

        $parametro = $_GET['ruta'];
        $retorno = Camion::getByRuta($parametro);


        if ($retorno) {

            $rutas["estado"] = "1";
            $rutas["rutas"] = $retorno;
            print json_encode($rutas);
        } else {
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }

    } else {
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita una ruta'
            )
        );
    }
}

?>
