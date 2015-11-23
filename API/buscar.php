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
            $persona["result"] = "true";
            $persona["horario"] = $retorno;
            if (array_key_exists('ID_PROFESOR', $retorno)) {
                $persona['clases']= Modelo::getClasesByIdForProfesor($id_persona);
            }else{
                $persona['clases']= Modelo::getClasesByIdForAlumno($id_persona);
            }
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