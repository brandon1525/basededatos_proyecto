<?php
error_reporting(E_ALL);
ini_set('display_errors','1');
header('Content-Type: application/json');

require 'modelo.php';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id = $_GET['id'];
        $id_configuracion = $_GET['id_configuracion'];
        $retorno = Modelo::update_configbyID($id,$id_configuracion);
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