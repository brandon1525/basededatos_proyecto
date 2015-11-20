<?php

require 'db_connect.php';

class Modelo{
    function __construct(){
    }
    //buscar inicarsesion
    public static function getAllConfiguracionPersona(){
        $consulta = "SELECT * FROM configuracion_persona";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }
    public static function getPersonaById($id_persona,$nombre,$apellido,$descripcion,$fecha_consulta,$hora_consulta)
    {
        
        $comando = "INSERT INTO formulario (" .
            " ID_PERSONA," .
            " NOMBRE," .
            " APELLIDO," .
            " DESCRIPCION," .
            " FECHA_CONSULTA,".
            " HORA_CONSULTA)" .
            " VALUES(?,?,?,?,?,?)";
        try{
            $sentencia = Database::getInstance()->getDb()->prepare($comando);
            $sentencia->execute(
                array(
                    $id_persona,
                    $nombre,
                    $apellido,
                    $descripcion,
                    $fecha_consulta,
                    $hora_consulta
                )
            );
            if($sentencia){
                $consulta = "SELECT * FROM persona where ID = ?";
                $comando = Database::getInstance()->getDb()->prepare($consulta);
                $comando->execute(array($id_persona));
                $rows = $comando->fetch(PDO::FETCH_ASSOC);
                if($rows){
                    $fila = array_values($rows);
                    $id_persona = $fila[0];
                    $consulta = "SELECT * FROM alumno where ID_PERSONA = ?";
                    $comando = Database::getInstance()->getDb()->prepare($consulta);
                    $comando->execute(array($id_persona));
                    $rows = $comando->fetch(PDO::FETCH_ASSOC);
                    if($rows){
                        //$fila = mysql_fetch_row($rows);
                        $consulta = "SELECT t8.ESTADO_CAMPUS,t8.CIUDAD_CAMPUS,t8.NOMBRE_CAMPUS,t8.CALLE,t8.NUMERO_EXT,t8.COLONIA,t8.LATITUD,t8.LONGITUD,t8.NOMBRE,t8.APELLIDOP,t8.APELLIDOM,t8.FECHA_NACIMIENTO,t8.CONTRA,t8.ID_CONFIGURACION,t8.SEMESTRE,t8.LETRA_GRUPO,carrera.NOMBRE AS NOMBRE_CARRERA FROM carrera
                        INNER JOIN(
                            (SELECT t7.ESTADO_CAMPUS,t7.CIUDAD_CAMPUS,t7.NOMBRE_CAMPUS,t7.CALLE,t7.NUMERO_EXT,t7.COLONIA,t7.LATITUD,t7.LONGITUD,t7.NOMBRE,t7.APELLIDOP,t7.APELLIDOM,t7.FECHA_NACIMIENTO,t7.CONTRA,t7.ID_CONFIGURACION,grupo.SEMESTRE,grupo.LETRA_GRUPO,grupo.ID_CARRERA FROM grupo
                            INNER JOIN(
                                (SELECT t6.ESTADO_CAMPUS,t6.CIUDAD_CAMPUS,t6.NOMBRE_CAMPUS,t6.CALLE,t6.NUMERO_EXT,t6.COLONIA,t6.LATITUD,t6.LONGITUD,persona.NOMBRE,persona.APELLIDOP,persona.APELLIDOM,persona.FECHA_NACIMIENTO,persona.CONTRA,persona.ID_CONFIGURACION,t6.ID_GRUPO_ALUMNO FROM persona
                                INNER JOIN(
                                    (SELECT t5.ESTADO_CAMPUS,ciudad.NOMBRE AS CIUDAD_CAMPUS,t5.NOMBRE_CAMPUS,t5.CALLE,t5.NUMERO_EXT,t5.COLONIA,t5.LATITUD,t5.LONGITUD,t5.ID_ALUMNO,t5.ID_GRUPO_ALUMNO FROM ciudad
                                    INNER JOIN(
                                        (SELECT estado.NOMBRE AS ESTADO_CAMPUS, t4.NOMBRE_CAMPUS,t4.CALLE,t4.NUMERO_EXT,t4.COLONIA,t4.ID_CIUDAD,t4.LATITUD,t4.LONGITUD,t4.ID_ALUMNO,t4.ID_GRUPO_ALUMNO FROM estado
                                        INNER JOIN(
                                            (SELECT t3.NOMBRE_CAMPUS,direccion.CALLE,direccion.NUMERO_EXT,direccion.COLONIA,direccion.ID_ESTADO,direccion.ID_CIUDAD,t3.LATITUD,t3.LONGITUD,t3.ID_ALUMNO,t3.ID_GRUPO_ALUMNO FROM direccion
                                            INNER JOIN(
                                                (SELECT campus.NOMBRE AS NOMBRE_CAMPUS,campus.ID_DIRECCION AS DIRECCION_CAMPUS,t2.LATITUD,t2.LONGITUD, t2.ID_ALUMNO,t2.ID_GRUPO_ALUMNO FROM campus
                                                INNER JOIN(
                                                    (SELECT ubicacion.LATITUD,ubicacion.LONGITUD,ubicacion.ID_CAMPUS,t1.ID_PERSONA AS ID_ALUMNO,t1.ID_GRUPO AS ID_GRUPO_ALUMNO FROM ubicacion
                                                    INNER JOIN( 
                                                        (SELECT * FROM alumno
                                                        where alumno.ID_PERSONA=?) AS t1)
                                                    ON ubicacion.ID=t1.ID_UBICACION) AS t2)
                                                ON campus.ID=t2.ID_CAMPUS) AS t3)
                                            ON direccion.ID=t3.DIRECCION_CAMPUS)AS t4)
                                        ON estado.ID=t4.ID_ESTADO)AS t5 )
                                    ON ciudad.ID=t5.ID_CIUDAD) AS t6)
                                ON persona.ID=t6.ID_ALUMNO) AS t7)
                            ON grupo.ID=t7.ID_GRUPO_ALUMNO) AS t8)
                        ON carrera.ID=t8.ID_CARRERA";
                        $comando = Database::getInstance()->getDb()->prepare($consulta);
                        $comando -> execute(array($id_persona));
                        $rows = $comando->fetchAll(PDO::FETCH_ASSOC);
                        return $rows;
                    }else{
                        //es profesor
                    }
                    //$fila = mysql_fetch_row($rows);
                    //echo $fila[0]; // 42
                    //echo $fila[1]; // el valor de email
                }else{
                    die(mysql_error());
                }
            }else{
                //no se ejecuto
                echo "No se pudo ejecutar con exito la consulta ($sql) en la BD: " . mysql_error();
            }
        }catch(PDOException $e){
            return false;
        }
    }


    public static function update($id,$ruta,$latitud,$longitud,$velocidad,$en_servicio)
    {
        $consulta = "UPDATE camion" .
            " SET ruta=?, latitud=?, longitud=?, velocidad=?, en_servicio=? " .
            "WHERE id=?";
        $cmd = Database::getInstance()->getDb()->prepare($consulta);
        $cmd->execute(array($ruta, $latitud, $longitud, $velocidad, $en_servicio, $id));
        return $cmd;
    }
    public static function insert($ruta,$latitud,$longitud,$velocidad,$en_servicio)
    {
        $comando = "INSERT INTO camion ( " .
            "ruta," .
            " latitud," .
            " longitud," .
            " velocidad," .
            " en_servicio)" .
            " VALUES(?,?,?,?,?)";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(
            array(
                $ruta,
                $latitud,
                $longitud,
                $velocidad,
                $en_servicio
            )
        );

    }

    public static function delete($id)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM camion WHERE id=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($id));
    }

    public static function getByRuta($ruta)
    {

        $consulta = "SELECT id,
                            ruta,
                            latitud,
                            longitud,
                            velocidad,
                            en_servicio
                             FROM camion
                             WHERE ruta = ?";

        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($ruta));
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            return -1;
        }
    }

}

?>
