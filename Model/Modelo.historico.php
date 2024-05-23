<?php
require_once ('conexion.php');

class modelo_historico{

    public static function model_buscar($data){
        try {
            $sql = "call sp_listar_historial_asignacion(?);";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp = 
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo sede ".$th->getMessage();
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