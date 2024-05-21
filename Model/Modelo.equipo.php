<?php
require_once ('conexion.php');

class modelo_equipo{

    public static function model_buscar(){
        
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
            $sql = "call insertar_equipo(?,?,?,?);";
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

    public static function model_eliminar(){
        
    }

    public static function model_actualizar(){
        
    }

}