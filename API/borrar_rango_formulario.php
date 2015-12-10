<?php
error_reporting(E_ALL);
ini_set('display_errors','1');
header('Content-Type: application/json');

require 'modelo.php';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $rango_inf = $_GET['rango_inf'];
        $rango_sup = $_GET['rango_sup'];
        $retorno = Modelo::deleteFormularioByFechas($rango_inf,$rango_sup);
        if ($retorno) {
            $persona["result"] = "true";
            $persona["exito"] = $retorno;
            echo json_encode($persona);
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