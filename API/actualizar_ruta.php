<?php
require 'camiones.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $id = $_GET['id'];
    $ruta = $_GET['ruta'];
    $latitud = $_GET['latitud'];
    $longitud =$_GET['longitud'];
    $velocidad =$_GET['velocidad'];
    $en_servicio =$_GET['en_servicio'];
    
    $retorno = Camion::update(
        $id,
        $ruta,
        $latitud,
        $longitud,
        $velocidad,
        $en_servicio);

    if ($retorno) {
        $arr=array('estado' => '1', 'mensaje' => 'Actualización éxitosa');
        print json_encode($arr);
    } else {
        $arr=array('estado' => '2','mensaje' => 'Actualización fallida');
        print json_encode();
    }
}
?>
