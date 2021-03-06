<?php
error_reporting(E_ALL);
ini_set('display_errors','1');
header('Content-Type: application/json');

require 'modelo.php';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id_persona = $_GET['id'];
        $contra = $_GET['contra'];
        $retorno = Modelo::ingresarPersonaById($id_persona,$contra);
        if ($retorno) {
            $persona["result"] = "true";
            $persona["datos"] = $retorno;
            $persona["configuracion_persona"] = Modelo::getConfigurationByIdForPerson($id_persona);
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