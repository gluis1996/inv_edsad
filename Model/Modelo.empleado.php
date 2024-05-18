<?php
require_once ('conexion.php');

class modelo_empleado{

    public static function model_buscar(){
        
    }

    public static function model_listar(){
        try {
            $sql = "SELECT *FROM empleados;";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo empleado ".$th->getMessage();
        }
        
    }

    public static function model_agregar(){
        
    }

    public static function model_eliminar(){
        
    }

    public static function model_actualizar(){
        
    }

}