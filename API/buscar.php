<?php
error_reporting(E_ALL);
ini_set('display_errors','1');
header('Content-Type: application/json');

require 'modelo.php';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id_persona = $_GET['id'];
        $nombre = $_GET['nombre'];
        $apellido = $_GET['apellido'];
        $descripcion = $_GET['razon'];
        $fecha_consulta = $_GET['fecha'];
        $hora_consulta = $_GET['hora'];
        $retorno = Modelo::getPersonaById($id_persona,$nombre,$apellido,$descripcion,$fecha_consulta,$hora_consulta);
        if ($retorno) {
            $horario["result"] = "true";
            $horario["horario"] = $retorno;
            echo json_encode($horario);
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