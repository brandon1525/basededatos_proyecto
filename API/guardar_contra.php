<?php
error_reporting(E_ALL);
ini_set('display_errors','1');
header('Content-Type: application/json');

require 'modelo.php';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id_persona = $_GET['id'];
        $contra = $_GET['contra'];
        $retorno = Modelo::update_contrabyID($id_persona,$contra);
        if ($retorno) {
            $persona["result"] = "true";
            $persona["datos"] = $retorno;
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