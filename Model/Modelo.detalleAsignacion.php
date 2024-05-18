<?php 

require_once ('conexion.php');

class modelo_detalleAsignacion{

    public static function model_buscar(){
        
    }

    public static function model_listar(){
        try {
            $sql = "call sp_obtener_detalle_asignacion();";
            $call = conexion::conectar()->prepare($sql);
            $call->execute();
            return $call->fetchAll();
        } catch (PDOException $e) {
            return "Erro: ".$e->getMessage();
        }
    }

    public static function model_agregar(){
        
    }

    public static function model_eliminar(){
        
    }

    public static function model_actualizar(){
        
    }

}