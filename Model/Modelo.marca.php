<?php
require_once ('conexion.php');

class modelo_marca{

    public static function model_buscar(){
        
    }

    public static function model_listar(){
        try {
            $sql = "SELECT *FROM marca;";
            $call = conexion::conectar()->prepare($sql);
            $call->execute();
            return $call->fetchAll();
        } catch (PDOException $e) {
            return "Erro: ".$e->getMessage();
        }
    }

    public static function model_agregar($data){
        try {
            $sql = "call InsertarMarca(?);";
            $call = conexion::conectar()->prepare($sql);
            $call->bindParam(1,$data['p_marca'],PDO::PARAM_STR);
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

    public static function model_actualizar($data){
        try {
            $sql = "UPDATE `equipos_informaticos`.`marca` SET `nombre` = ? WHERE `idmarca` = ?;";
            $call = conexion::conectar()->prepare($sql);
            $call->bindParam(1,$data['marca_nombre'],PDO::PARAM_STR);
            $call->bindParam(2,$data['marca_id'],PDO::PARAM_STR);
            if ($call->execute()) {
                return 'ok';
            } else {
                return 'fallo';
            }
            
            
        } catch (PDOException $e) {
            return "Erro: ".$e->getMessage();
        }
    }

}