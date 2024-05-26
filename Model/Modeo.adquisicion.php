<?php
require_once('conexion.php');

class modelo_adquisicion{


    public static function m_listar() {
        try {
            $sql = "call sp_listar_detalle_adquisicion();";
            $call = conexion::conectar()->prepare($sql);
            $call->execute();
            return $call->fetchAll();
        } catch (PDOException $th) {
            return 'Error: '.$th->getMessage();
        }
    }

    public static function m_eliminar() {
        try {
            $sql = "DELETE FROM `equipos_informaticos`.`detalle_adquisicion` WHERE  id_detalle_aquisicion = ?;";
            $call = conexion::conectar()->prepare($sql);
            $call->bindParam(1,$data,PDO::PARAM_STR);
            if ($call->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
        } catch (PDOException $th) {
            return 'Error: '.$th->getMessage();
        }
    }

    public static function m_buscar($data) {
        try {
            $sql = "call sp_buscar_detalle_adquisicion(?)";
            $call = conexion::conectar()->prepare($sql);
            $call->bindParam(1,$data,PDO::PARAM_STR);   
            $call->execute();
            return $call->fetchAll();
        } catch (PDOException $th) {
            return 'Error: '.$th->getMessage();
        }
    }

    public static function m_registrar($data) {
        try {
            $sql = "call sp_insert_detalle_adquisicion(?,?,?,?,?,?);";
            $call= conexion::conectar()->prepare($sql);
            $call->bindParam(1,$data['p_id_area_usuaria'],PDO::PARAM_INT);
            $call->bindParam(2,$data['p_idbeneficiario'],PDO::PARAM_INT);
            $call->bindParam(3,$data['p_idequipos'],PDO::PARAM_INT);
            $call->bindParam(4,$data['p_idmeta'],PDO::PARAM_INT);
            $call->bindParam(5,$data['p_anio_aquisicion'],PDO::PARAM_INT);
            $call->bindParam(6,$data['p_cantidad'],PDO::PARAM_INT);
            if ($call->execute()) {
                return 'ok';
            }else{
                return 'fallo';
            }

        } catch (PDOException $e) {
            return 'Error detalle asignacion : '.$e->getMessage();
        }
    }


    public static function m_editar($data) {
        try {
            $sql = "call sp_actualizar_detalle_adquisicion(?,?,?,?,?,?,?);";
            $call= conexion::conectar()->prepare($sql);
            $call->bindParam(1,$data['p_id_detalle_aquisicion'],PDO::PARAM_INT);
            $call->bindParam(2,$data['p_id_area_usuaria'],PDO::PARAM_INT);
            $call->bindParam(3,$data['p_idbeneficiario'],PDO::PARAM_INT);
            $call->bindParam(4,$data['p_idequipos'],PDO::PARAM_INT);
            $call->bindParam(5,$data['p_idmeta'],PDO::PARAM_INT);
            $call->bindParam(6,$data['p_anio_aquisicion'],PDO::PARAM_INT);
            $call->bindParam(7,$data['p_cantidad'],PDO::PARAM_INT);
            if ($call->execute()) {
                return 'ok';
            }else{
                return 'fallo';
            }

        } catch (PDOException $e) {
            return 'Error detalle asignacion : '.$e->getMessage();
        }
    }

}
