<?php
require_once ('conexion.php');

class modelo_equipo{

    public static function model_buscar($data){
        try {
            $sql = "SELECT *FROM equipos WHERE idequipos = ?;";
            $call = conexion::conectar()->prepare($sql);
            $call->bindParam(1,$data['idequipos'],PDO::PARAM_STR);
            $call->execute();
            return $call->fetchAll();
        } catch (PDOException $e) {
            return "Erro: ".$e->getMessage();
        }
    }

    public static function model_listar(){
        try {
            $sql = "call sp_listar_equipo();";
            $call = conexion::conectar()->prepare($sql);
            $call->execute();
            return $call->fetchAll();
        } catch (PDOException $e) {
            return "Erro: ".$e->getMessage();
        }
        
    }

    public static function model_agregar($data){
        try {
            $sql = "call sp_insertar_equipo(?,?,?,?);";
            $call = conexion::conectar()->prepare($sql);
            $call->bindParam(1,$data['p_modelo'],PDO::PARAM_STR);
            $call->bindParam(2,$data['p_descripcion'],PDO::PARAM_STR);
            $call->bindParam(3,$data['p_fecha_registro'],PDO::PARAM_STR);
            $call->bindParam(4,$data['p_idmarca'],PDO::PARAM_STR);
            if ($call->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
            
        } catch (PDOException $e) {
            return "Erro: ".$e->getMessage();
        }
    }

    public static function model_eliminar($data){
        try {
            $sql = "DELETE FROM `equipos_informaticos`.`equipos`WHERE idequipos = ?;";
            $call = conexion::conectar()->prepare($sql);
            $call->bindParam(1,$data['idequipos'],PDO::PARAM_STR);
            if ($call->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
        } catch (PDOException $e) {
            return "Erro: ".$e->getMessage();
        }
    }

    public static function model_actualizar($data){
        try {
            $sql = "call sp_actualizar_equipo(?,?,?,?,?);";
            $call = conexion::conectar()->prepare($sql);
            $call->bindParam(1,$data['p_idequipos'],PDO::PARAM_STR);
            $call->bindParam(2,$data['p_modelo'],PDO::PARAM_STR);
            $call->bindParam(3,$data['p_descripcion'],PDO::PARAM_STR);
            $call->bindParam(4,$data['p_fecha_registro'],PDO::PARAM_STR);
            $call->bindParam(5,$data['p_idmarca'],PDO::PARAM_STR);
            if ($call->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }            
        } catch (PDOException $e) {
            return "Error: ".$e->getMessage();
        }
    }

}