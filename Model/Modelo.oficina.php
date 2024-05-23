<?php
require_once ('conexion.php');

class modelo_oficina{

    public static function model_buscar(){

    }

    public static function model_listar(){
        try {
            $sql = "call obtener_oficinas_y_sedes();";
            $stmp = conexion::conectar()->prepare($sql);
            $stmp->execute();
            return $stmp->fetchAll();
        } catch (PDOException $th) {
            return "Modelo Meta ".$th->getMessage();
        }
        
        
    }

    public static function model_agregar(){
        
    }

    public static function model_eliminar(){
        
    }

    public static function model_actualizar(){
        
    }

}
