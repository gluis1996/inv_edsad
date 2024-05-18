<?php
require_once ('conexion.php');

class modelo_oficina{

    public static function model_buscar($data){
        try {
            $sql = "call GetOficinasBySede(?);";
            $call = conexion::conectar()->prepare($sql);
            $call->bindParam(1,$data,PDO::PARAM_STR);
            $call->execute();
            return $call->fetchAll();
        } catch (PDOException $e) {
            return "Error : ".$e->getMessage();
        }
    }

    public static function model_listar(){
        
    }

    public static function model_agregar(){
        
    }

    public static function model_eliminar(){
        
    }

    public static function model_actualizar(){
        
    }

}
