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
                $consulta = "SELECT * FROM vista1 WHERE ID = ?";
                $comando = Database::getInstance()->getDb()->prepare($consulta);
                $comando->execute(array($id_persona));
                $rows = $comando->fetch(PDO::FETCH_ASSOC);
                if($rows){
                    $fila = array_values($rows);
                    $id_persona = $fila[0];
                    $consulta = "SELECT * FROM vista2 where ID_PERSONA = ?";
                    $comando = Database::getInstance()->getDb()->prepare($consulta);
                    $comando->execute(array($id_persona));
                    $rows = $comando->fetch(PDO::FETCH_ASSOC);
                    if($rows){
                        //$fila = mysql_fetch_row($rows);
                        $consulta = "SELECT * FROM vista3 WHERE ID_ALUMNO=?";

                        $comando = Database::getInstance()->getDb()->prepare($consulta);
                        $comando -> execute(array($id_persona));
                        $rows = $comando->fetchAll(PDO::FETCH_ASSOC);
                        return $rows;
                    }else{
                        $consulta = "SELECT * FROM vista4 WHERE ID_PERSONA=?";
                        $comando = Database::getInstance()->getDb()->prepare($consulta);
                        $comando -> execute(array($id_persona));
                        $rows = $comando->fetchAll(PDO::FETCH_ASSOC);
                        return $rows;
                    }
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
    public static function getClasesByIdForAlumno($id_alumno){
        try{
            $consulta = "SELECT * FROM vista_clase_alumno WHERE ID_ALUMNO=?";
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id_alumno));
            $rows = $comando->fetchAll(PDO::FETCH_ASSOC);
            if($rows){
                return $rows;
            }else{
                echo "Esa persona (alumno) no tiene clases clases" . mysql_error();
            }
        }catch(PDOException $e){
            return false;
        }
    }
    public static function getClasesByIdForProfesor($id_profesor){
        try{
            $consulta = "SELECT * FROM vista_clase_profesor WHERE ID_PROFESOR = ? group by HORA_INICIO";
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id_profesor));
            $rows = $comando->fetchAll(PDO::FETCH_ASSOC);
            if($rows){
                return $rows;
            }else{
                echo "Esa persona (profesor) no tiene clases clases".mysql_error();
            }
        }catch(PDOException $e){
            return false;
        }
    }
    public static function getConfigurationByIdForPerson($id_persona){
        try{
            $consulta = "SELECT configuracion_persona.COMPARTIR_UBICACION,configuracion_persona.COMPARTIR_HORARIO,configuracion_persona.COMPARTIR_PROFESOR FROM configuracion_persona
            INNER JOIN(
                (SELECT * FROM persona
                WHERE persona.ID=?)AS T1)
            ON configuracion_persona.ID=T1.ID_CONFIGURACION";
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id_persona));
            $rows = $comando->fetchAll(PDO::FETCH_ASSOC);
            if($rows){
                return $rows;
            }else{
                echo "Algo salio mal al obtener la configuracion_persona".mysql_error();
            }
        }catch(PDOException $e){
            return false;
        }
    }
    public static function ingresarPersonaById($id_persona,$contra)
    {
        try{
            $consulta = "SELECT * FROM persona WHERE ID = ?";
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id_persona));
            $rows = $comando->fetchAll(PDO::FETCH_ASSOC);
            if($rows){
                return $rows;
            }else{
                echo "Esa persona no existe".mysql_error();
            }
        }catch(PDOException $e){
            return false;
        }
    }
    public static function update_configbyID($id,$id_configuracion)
    {
        try{
            $consulta = "UPDATE persona SET ID_CONFIGURACION=? WHERE ID=?";
            $cmd = Database::getInstance()->getDb()->prepare($consulta);
            $cmd->execute(array($id_configuracion,$id));
            return $cmd;   
        }catch(PDOException $e){
            return false;
        }
        
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
