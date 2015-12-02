<?php
error_reporting(E_ALL);
ini_set('display_errors','1');
header('Content-Type: application/json');

require 'modelo.php';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id = $_GET['id'];
        $compartir_ubicacion = $_GET['compartir_ubicacion'];
        $compartit_horario = $_GET['compartit_horario'];
        $compartit_profesor = $_GET['compartit_profesor'];
        $retorno = Modelo::update_configbyID($compartir_ubicacion,$compartit_horario,$compartit_profesor);
        if ($retorno) {
            $persona["result"] = "true";
            $persona["horario"] = $retorno;
            if (array_key_exists('TIPO_PROFESOR', $retorno[0])) {
                $persona['clases']= Modelo::getClasesByIdForProfesor($id_persona);
            }else{
                $persona['clases']= Modelo::getClasesByIdForAlumno($id_persona);
            }
            $persona['configuracion']=Modelo::getConfigurationByIdForPerson($id_persona);
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