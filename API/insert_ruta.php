<?php

require 'camiones.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {


    $ruta = $_GET['ruta'];
    $latitud = $_GET['latitud'];
    $longitud =$_GET['longitud'];
    $velocidad =$_GET['velocidad'];
    $en_servicio =$_GET['en_servicio'];

    echo $ruta;
    echo $latitud;
    echo $longitud;
    echo $velocidad;
    echo $en_servicio;

    $retorno = Camion::insert(
        $ruta,$latitud,$longitud,$velocidad,$en_servicio
        );
    echo "Si se mandos";
    if ($retorno) {
        // Código de éxito
        print json_encode(
            array(
                'estado' => '1',
                'mensaje' => 'Creación éxitosa')
        );
         echo "se hizo";
    } else {
        // Código de falla
        print json_encode(
            array(
                'estado' => '2',
                'mensaje' => 'Creación fallida')
        );
    }
    echo "no se hizo";
}

?>
