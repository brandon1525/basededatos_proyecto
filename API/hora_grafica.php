<?php
error_reporting(E_ALL);
ini_set('display_errors','1');
header('Content-Type: application/json');

require 'modelo.php';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $retorno = Modelo::Hora_grafica();
        if ($retorno) {
            $estadisticas["result"] = "true";
            $estadisticas["datos"] = $retorno;
            echo json_encode($estadisticas);
        } else {
            echo json_encode(
                array(
                    'result' => 'false',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }
    }
?>